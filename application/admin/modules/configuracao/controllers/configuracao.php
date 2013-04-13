<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Target
 *
 * Sistema CMS W3case Target
 * Target - Sua melhor solução em manutenção para seu website. Um produto da Agência W3Case
 *
 * @package		Target
 * @author		W3Case Soluções Interativas
 * @copyright           Copyright (c) 2007 - 2013, W3Case, LTDA.
 * @license		Todos os direitos reservados a w3case soluções interativas
 * @link		http://www.w3case.com.br/target
 * @since		Version 4.0
 * @filesource
 */
// ------------------------------------------------------------------------

class Configuracao extends MX_Controller {
    /*
     * Classe construtora
     * Aqui é verificado a autenticidade do usuário
     * e se o mesmo tem acesso a está funcionalidade do sistema
     */

    public function __construct()
    {
        // Utilização da classe construtura da superclasse
        parent::__construct();

        /*
         * Verifica se o usuário está logado, caso contrário, envio o mesmo para 
         * a página de login
         */
        if ($this->session->userdata('logado') == true)
        {
            /*
             * @link http://php.net/manual/en/function.date-default-timezone-set.php
             * @param string $timezone_identifier
             */
            $this->load->model('configuracoes');
            $config = $this->configuracoes->getDados("timezone");
            date_default_timezone_set($config[0]->parametros);
        }
        else
        {
            // Redireciona se nao houver uma sessao aberta para o usuario
            print "<script>self.location = '" . base_url() . "'</script>";
        }
    }

    /*
     * Chamadas para as páginas
     */

    public function index()
    {
        $data['pagina'] = "configuracoes";
        $this->load->view('principal/principal', $data);
    }

    /**
     * Metodo geral para inclusão da página de configuração
     * geral
     *
     * Mapeamento da URL
     * 	http://example.com/admin/configuracao/geral
     */
    public function geral()
    {
        // Load do arquivo de manipulação do banco
        $this->load->model("crud");

        // Gerar Logs
        $this->load->library('my_log');
        $logs = new MY_Log();
        $logs->setLogPath(APPPATH . "logs/" . $this->session->userdata('nome') . "/");
        $logs->write_log('info', "O usuario acessou a área de configurações gerais");

        // Seleciona as configurações 
        $data['configs'] = $this->crud->simpleSelect("config", array("grupo" => "Geral"));

        $data['pagina'] = "geral";
        $this->load->view('principal/principal', $data);
    }

    public function emails()
    {
        // Load do arquivo de manipulação do banco
        $this->load->model("crud");

        // Gerar Logs
        $this->load->library('my_log');
        $logs = new MY_Log();
        $logs->setLogPath(APPPATH . "logs/" . $this->session->userdata('nome') . "/");
        $logs->write_log('info', "O usuario acessou a área de configurações de emails");

        // Seleciona as configurações 
        $data['configs'] = $this->crud->simpleSelect("config", array("grupo" => "Email"));

        $data['pagina'] = "emails";
        $this->load->view('principal/principal', $data);
    }

    public function metasAnalytics()
    {
        // Load do arquivo de manipulação do banco
        $this->load->model("crud");

        // Gerar Logs
        $this->load->library('my_log');
        $logs = new MY_Log();
        $logs->setLogPath(APPPATH . "logs/" . $this->session->userdata('nome') . "/");
        $logs->write_log('info', "O usuario acessou a área de configurações de MetaTags / Analytics");

        // Seleciona as configurações 
        $data['configs'] = $this->crud->simpleSelect("config", array("grupo" => "Metas"));

        $data['pagina'] = "metas-analytics";
        $this->load->view('principal/principal', $data);
    }

    public function manutencao()
    {
        $data['pagina'] = "manutencao";
        $this->load->view('principal/principal', $data);
    }

    public function tempo()
    {
        // Load do arquivo de manipulação do banco
        $this->load->model("crud");

        // Gerar Logs
        $this->load->library('my_log');
        $logs = new MY_Log();
        $logs->setLogPath(APPPATH . "logs/" . $this->session->userdata('nome') . "/");
        $logs->write_log('info', "O usuario acessou a área de configurações do Codigo do tempo");

        // Seleciona as configurações 
        $data['configs'] = $this->crud->simpleSelect("config", array("grupo" => "Tempo"));
        
        $data['pagina'] = "tempo";
        $this->load->view('principal/principal', $data);
    }

    public function atualizarDados()
    {
        // Load do arquivo de manipulação do banco
        $this->load->model("crud");

        foreach ($_POST as $key => $value)
        {
            $this->crud->update("config", "idConfiguracao", array("idConfiguracao" => $key, "parametros" => $value));

            // Gerar Logs
            $this->load->library('my_log');
            $logs = new MY_Log();
            $logs->setLogPath(APPPATH . "logs/" . $this->session->userdata('nome') . "/");
            $logs->write_log('info', "O usuario mudou a configuracao: " . $key . " para " . $value);
        }

        echo '<div class="alert alert-success" id="msgout">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <h4>Sucesso!</h4>Configurações Salvas
              </div>';
    }

    public function efeturaManutencao()
    {
        if (@$_POST['backup'])
        {
            $backup = true;
        }
        else
        {
            $backup = false;
        }

        // Carrega classe para manutenção
        $this->load->model('manutencao');
        $this->load->model('crud');
        
        // Metodo reparar
        $this->manutencao->reparar($backup);
        
        if ($this->db->table_exists("materias"))
        {
            @$this->crud->delete("materias", "titulo", array("titulo is" => "null"));
        }
        if ($this->db->table_exists("fotos"))
        {
            @$this->crud->delete("fotos", "titulo", array("titulo is" => "null"));
        }
        if ($this->db->table_exists("textos"))
        {
            @$this->crud->delete("textos", "titulo", array("titulo is" => "null"));
        }
        if ($this->db->table_exists("agenda"))
        {
            @$this->crud->delete("agenda", "titulo", array("titulo is" => "null"));
        }
        if ($this->db->table_exists("arquivos"))
        {
            @$this->crud->delete("arquivos", "titulo", array("titulo is" => "null"));
        }
        if ($this->db->table_exists("enquete_ip"))
        {
            @$this->crud->delete("enquete_ip");
        }
        
        echo '<div class="alert alert-success" id="msgout">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <h4>Sucesso!</h4>Configurações Salvas
              </div>';
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */