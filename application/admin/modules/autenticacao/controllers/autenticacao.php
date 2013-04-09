<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Autenticacao extends MX_Controller {

    // Atributos para validar o login 
    private $usuario;
    private $senha;

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -  
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $this->load->view('login');
    }

    /**
     * Metodo equivalente ao Set
     * Recebe os dados e envia para o método que tratará 
     * os dados do usuário
     */
    public function setDados()
    {
        $this->usuario = $_POST['usuario'];
        $this->senha = $_POST['senha'];
        $this->autenticarDadosUsuário();
    }

    /*
     * Método para verificar no banco se existe ou não
     * o usuário especificado no login
     */
    private function autenticarDadosUsuário()
    {
        // Dados para a autenticação
        $dados_login = array(
            "email" => $this->anti_injection($this->usuario),
            "status" => 1,
            "lixeira" => 2,
            "senha" => md5($this->anti_injection($this->senha))
        );

        // Carregar a classe para manipular os dados no banco
        // Local /application/model/crud.php
        $this->load->model("crud");

        // Parämetro para a seleção do usuário
        $parametros = array(
            "select" => "*",
            "table" => "usuarios",
            "where" => $dados_login,
            "order_by" => "",
            "group_by" => "",
            "limit" => "",
            "like" => "",
            "join" => ""
        );

        // Retorna os dados do usuário
        $retorno = $this->crud->select($parametros, false);

        if ($retorno)
        {
            // Atualiza versao no banco
            $versao = Version();
            $this->load->model('configuracoes');
            if ($versao[0]->cod)
            {
                // Executa o update para atualizar a versão do sistema
                $this->crud->update("version", $id_name = "", array("version" => "$versao[0]->cod"));
            }

            // Caso o usuário seja Master
            if ($retorno[0]->tipo == 1)
            {
                /*
                 * Parämetro para a seleção dos menus que serão 
                 * visíveis pelo usuário
                 */
                $parametros = array(
                    "select" => "*",
                    "table" => "menu",
                    "where" => "",
                    "order_by" => "",
                    "group_by" => "",
                    "limit" => "",
                    "like" => "",
                    "join" => ""
                );

                // Verifica se o usuário é master
                $menu = "";
                $permissaoMaster = $this->crud->select($parametros);
                foreach ($permissaoMaster as $pm)
                {
                    $menu .= $pm->menuId . ",";
                }

                // Dados para autenticação
                $array = array(
                    'logado' => true,
                    'id_usuario' => $retorno[0]->id,
                    'email' => $retorno[0]->email,
                    'nome' => $retorno[0]->nome,
                    'data' => $retorno[0]->data_acesso,
                    'menu' => explode(',', $menu),
                    'tipo' => $retorno[0]->tipo
                );
            }
            else
            {
                // Dados para autenticação
                $array = array(
                    'logado' => true,
                    'id_usuario' => $retorno[0]->id,
                    'email' => $retorno[0]->email,
                    'nome' => $retorno[0]->nome,
                    'data' => $retorno[0]->data_acesso,
                    'menu' => explode(',', $retorno[0]->permissoes),
                    'tipo' => $retorno[0]->tipo
                );
            }

            // Cria a sessão para o usuário logado
            $this->session->set_userdata($array);

            // Gravar no banco a data e o ip de acesso
            $dados = array(
                "id" => $retorno[0]->id,
                "ip_acesso" => $_SERVER['REMOTE_ADDR'],
                'data_acesso' => date("Y-m-d H:i:s")
            );
            $this->crud->update('usuarios', 'id', $dados);

            /*
             * Parämetro para a seleção da versao do sistema
             */
            $parametros = array(
                "select" => "*",
                "table" => "version",
                "where" => "",
                "order_by" => "",
                "group_by" => "",
                "limit" => "",
                "like" => "",
                "join" => ""
            );

            // Gerar Logs
            $this->load->library('my_log');
            $logs = new MY_Log();
            $logs->setLogPath(APPPATH . "logs/" . $retorno[0]->nome . "/");
            $logs->write_log('info', "O usuario logou no sistema");

            $versaoSistema = $this->crud->select($parametros);

            /*
             * Verifica a versão é redireciona o usuário
             * Caso versão desatualizada, direcionada à area de atualização
             * Caso versão atualizada, direciona à area principal
             */
            if ($versaoSistema[0]->version != $versaoSistema[0]->version_atual && $retorno[0]->tipo <= 2)
            {
                print "<script>self.location = '" . base_url() . "admin.php/atualizar_sistema'</script>";
            }
            else
            {
                print "<script>self.location = '" . base_url() . "admin.php/principal'</script>";
            }
        }
        else
        {
            echo '<div class="alert alert-error">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <h4>Erro!</h4>Usuário não cadastrado no sistema
                  </div>';
        }
    }

    // remove palavras que contenham sintaxe sql
    private function anti_injection($sqlinj)
    {
        $sqlinj = preg_replace("/(from|select|insert|delete|where|drop table|show tables|#|hi|'|´|\*|--|\\\\)/i", '', $sqlinj);
        $sqlinj = trim($sqlinj); //limpa espaços vazio
        $sqlinj = strip_tags($sqlinj); //tira tags html e php
        return $sqlinj;
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */