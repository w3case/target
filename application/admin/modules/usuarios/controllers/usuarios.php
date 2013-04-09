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

class Usuarios extends MX_Controller {

    private $email;
    private $senha;

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

    /**
     * Metodo index para inclusão da página principal
     *
     * Mapeamento da URL
     * 	http://example.com/index.php/usuarios
     * 	- or -  
     * 	http://example.com/index.php/usuarios/index
     */
    public function index()
    {
        $data['pagina'] = "usuarios";
        $this->load->view('principal/principal', $data);
    }

    /**
     * Metodo index para inclusão da página principal
     *
     * Mapeamento da URL
     * 	http://example.com/index.php/usuarios/cadastrar
     * 	- or -  
     * 	http://example.com/index.php/usuarios/cadastrar
     */
    public function cadastrar()
    {
        // Carrega os dados das configuracoes
        $this->load->model('menu');
        
        // Gerar Logs
        $this->load->library('my_log');
        $logs = new MY_Log();
        $logs->setLogPath(APPPATH . "logs/" . $this->session->userdata('nome'). "/");
        $logs->write_log('info', "O usuario acessou a area de cadastro de novos usuários");

        // Permissões do usuário
        $data['menus'] = $this->menu->getIdMenu($this->session->userdata('menu'));
        $data['qtdMenus'] = $this->menu->getQtdMenuPai($this->session->userdata('menu'));
        
        $data['pagina'] = "cadastrar";
        $this->load->view('principal/principal', $data);
    }

    /**
     * Metodo index para inclusão da página principal
     *
     * Mapeamento da URL
     * 	http://example.com/index.php/usuarios/gerenciar
     * 	- or -  
     * 	http://example.com/index.php/usuarios/gerenciar
     */
    public function gerenciar()
    {
        $data['pagina'] = "gerenciar";
        $this->load->view('principal/principal', $data);
    }

    /**
     * Metodo index para inclusão da página principal
     *
     * Mapeamento da URL
     *  http://example.com/index.php/usuarios/lixeira
     * 	- or -  
     * 	http://example.com/index.php/usuarios/lixeira
     */
    public function lixeira()
    {
        $data['pagina'] = "lixeira";
        $this->load->view('principal/principal', $data);
    }

    /**
     * Metodo equivalente ao Set
     * Recebe os dados e envia para o método que tratará 
     * os dados do usuário
     */
    public function setDados()
    {
        $this->email = $_POST['email'];
        $this->senha = $_POST['senha'];
    }

}

/* End of file usuarios.php */
/* Location: ./application/modules/controllers/usuarios.php */