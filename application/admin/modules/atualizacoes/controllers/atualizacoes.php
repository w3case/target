<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Atualizacoes extends MX_Controller {

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
        $data['pagina'] = "atualizacoes";
        $this->load->view('principal/principal', $data);
    }

    public function atualizarSistema()
    {
        $this->load->model('configuracoes');
        $permissoes = $this->configuracoes->getPermissoes();

        /*
         * Caso o módulo de permissão não esteja ativo, apresenta a mensagem 
         * de erro
         */
        if ($permissoes[0]->status == 2)
        {
             echo '<div class="alert alert-error">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <h4>Erro!</h4>Você não possui permissão para atualizar o sistema. Entre em contato com o suporte técnico.
                  </div>';
             exit;
        }
        
        /*
         * Caso o usuário não seja administrador, apresenta a mensagem de erro
         * Somente administradores podem atualizar o sistema
         */
        if ($this->session->userdata('tipo') > 2)
        {
            echo '<div class="alert alert-error">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <h4>Erro!</h4>Você não possui permissão para atualizar o sistema. Entre em contato com o administrador.
                  </div>';
             exit;
        }

        // Configuracoes
        $this->load->model('configuracoes');

        // Carrega o source do sistema para a pasta temporária
        //copy("http://www.whostbr.com.br/cms/repositorio/4.0/target.zip", $this->configuracoes->getDados("caminhoRaiz") . "temp/target.zip");      

        // Limpa a tablea Menu
        $this->load->model('crud');

        // Inclui as configurações
        include_once '../config/config.php';

        // Conectar no ftp
        $this->load->library('ftp');
        $config['hostname'] = FTP_HOSTNAME;
        $config['username'] = FTP_USERNAME;
        $config['password'] = FTP_PASSWORD;
        $config['passive'] = FALSE;
        $config['debug'] = TRUE;

        // Envia as configuracoes
        $this->ftp->connect($config); exit;

        $this->load->library('my_pclzip');

        echo "<b>Baixando M&oacute;dulos da vers&atilde;o: </b>3.X<br /><br />";
        foreach ($modulos as $modulo):
            // Deleta conteudo dos modulos
            $this->ftp->delete_dir($configs[0]->path_public . "application/admin/modules/" . $modulo->modulos . "/");
            $this->ftp->move($configs[0]->path_public . "temp/" . $modulo->modulos . ".zip", $configs[0]->path_public . "application/admin/modules/" . $modulo->modulos . ".zip");
            $zip = new PclZip($configs[0]->path_modulos_admin . $modulo->modulos . ".zip");
            if ($zip->extract(PCLZIP_OPT_PATH, $configs[0]->path_modulos_admin, PCLZIP_OPT_REMOVE_PATH, 'install/release') == 0)
            {
                die("Error : " . $zip->errorInfo(true));
            }
            $this->load->file("application/admin/modules/" . $modulo->modulos . "/sql/sql.php");

            $this->ftp->delete_file($configs[0]->path_public . "application/admin/modules/" . $modulo->modulos . ".zip");
            echo "<b>" . $modulo->modulos . "</b>" . " - atualizado com sucesso<br />";
            mysql_close();
        endforeach;

        // Vetor das bibliotecas
        $bibliotecas = array("helpers", "libraries");

        echo "<br /><b>Baixando Helpers e Libraries da vers&atilde;o: </b>3.X<br /><br />";
        foreach ($bibliotecas as $biblioteca):
            // Deleta conteudo dos modulos
            $this->ftp->delete_dir($configs[0]->path_public . "application/admin/" . $biblioteca . "/");
            $this->ftp->move($configs[0]->path_public . "temp/" . $biblioteca . ".zip", $configs[0]->path_public . "application/admin/" . $biblioteca . ".zip");
            $zip = new PclZip($configs[0]->path_raiz . "application/admin/" . $biblioteca . ".zip");
            if ($zip->extract(PCLZIP_OPT_PATH, $configs[0]->path_raiz . "application/admin/", PCLZIP_OPT_REMOVE_PATH, 'install/release') == 0)
            {
                die("Error : " . $zip->errorInfo(true));
            }
            //$this->load->file("application/admin/" . $biblioteca . "/sql/sql.php");
            $this->ftp->delete_file($configs[0]->path_public . "application/admin/" . $biblioteca . ".zip");
            echo "<b>" . $biblioteca . "</b>" . " - atualizado com sucesso<br />";
        endforeach;

        // Fechando a conexão com o ftp
        $this->ftp->close();

        // Gravar no banco a nova versao do sistema
        $versao = $this->configuracoes->version();

        //$this->load->model("crud");
        $dados = array(
            'version' => $versao[0]->version_atual
        );
        $this->crud->atualizar('version', '', $dados);

        // Logs do sistema
        $this->load->library('logs');
        $config = array(
            'path' => 'application/admin/logs/' . $this->session->userdata('nome') . '/',
            'tipo' => 'xml',
            'arquivo' => date('d-m-Y')
        );
        $this->logs->inicialize($config);
        $this->logs->Gerarlog('O usuario atualizou o sistema para a versão ' . $versao[0]->version_atual);

        // Enviar Email para o responsável do sistema
        $this->load->helper('url');
        $this->load->library('email');
        $this->email->from('suporte@w3case.com.br', 'Target - W3Case');
        $this->email->to('luizpicolo@w3case.com.br');
        $this->email->subject('Notificação de Atualização');
        $this->email->message('O usuário ' . site_url() . ' atualizou o sistema para a versão ' . $versao[0]->version_atual);
        $this->email->send();

        MsgError("SUCESSO", "Modulos atualizados. Relogue-se");
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */