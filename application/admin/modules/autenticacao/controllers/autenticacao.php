<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Autenticacao extends MX_Controller 
{
    
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
        $this->verificarDadosUsuario();
    }
    
    /*
     * Método para verificar no banco se existe ou não
     * o usuário especificado no login
     */
    private function verificarDadosUsuario()
    {
        // Dados para a autenticação
        $dados_login = array(
            "email" => $this->anti_injection($this->usuario),
            "status" => 1,
            "lixeira" => 2,
            "senha" => md5($this->anti_injection($this->senha))
        );
                
        // Carregar a classe para manipular os dados no banco
        $this->load->model("crud"); exit;
        
        $retorno = $this->crud->mostrar_onde("usuarios", $dados_login);
        if ($retorno)
        {
            // Logs do sistema
            $this->load->library('logs');
            $config = array(
                'path' => 'application/admin/logs/' . $retorno[0]->nome . '/',
                'tipo' => 'xml',
                'arquivo' => date('d-m-Y')
            );
            $this->logs->inicialize($config);
            $this->logs->Gerarlog('O usuario ' . $retorno[0]->nome . ' acessou o sistema com a senha ' . $_POST['senha']);

            // Atualiza versao no banco
            $versao = Version();
            $this->load->model('configuracoes');
            if ($versao[0]->cod)
            {
                $this->configuracoes->atualizar_version($versao[0]->cod);
            }

            //tema
            $tema = $this->configuracoes->tema();

            if ($retorno[0]->tipo == 1)
            {
                // Verifica se o usuário é master
                $permissao_master = $this->crud->mostrar("menu");
                foreach ($permissao_master as $pm)
                {
                    $menu .= $pm->menuId . ",";
                }

                // Dados para autenticação
                $array = array(
                    'logado' => true,
                    'id_usuario' => $retorno[0]->id,
                    'usuario' => $retorno[0]->usuario,
                    'email' => $retorno[0]->email,
                    'nome' => $retorno[0]->nome,
                    'data' => $retorno[0]->data_acesso,
                    'tema' => $tema[0]->tema,
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
                    'usuario' => $retorno[0]->usuario,
                    'email' => $retorno[0]->email,
                    'nome' => $retorno[0]->nome,
                    'data' => $retorno[0]->data_acesso,
                    'tema' => $tema[0]->tema,
                    'menu' => explode(',', $retorno[0]->permissoes),
                    'tipo' => $retorno[0]->tipo
                );
            }
            $this->session->set_userdata($array);

            // Gravar no banco a data e o ip de acesso
            $dados = array(
                "id" => $retorno[0]->id,
                "ip_acesso" => $_SERVER['REMOTE_ADDR'],
                'data_acesso' => date("Y-m-d H:i:s")
            );
            $this->crud->atualizar('usuarios', 'id', $dados);
            
            // Verificar login
            $version = $this->crud->mostrar("version");
            
            if ($version[0]->version != $version[0]->version_atual && $retorno[0]->tipo <= 2)
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
            echo "Usuário inexistente.";
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