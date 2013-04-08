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
    
    private $usuario;
    private $senha;

    /**
     * Metodo index para inclusão da página principal
     *
     * Mapeamento da URL
     * 		http://example.com/index.php/usuarios
     * 	- or -  
     * 		http://example.com/index.php/usuarios/index
     */
    public function index()
    {
        // Gerar Logs
//        $this->load->library('my_log');
//        $logs = new MY_Log();
//        $logs->setLogPath(APPPATH . "logs/" . $this->session->userdata('nome') . "/");
//        $logs->write_log('info', "O usuario acessou o cadastre de novos su");
        
        $data['pagina'] = "usuarios";
        $this->load->view('principal/principal', $data);
    }
    
    /**
     * Metodo index para inclusão da página principal
     *
     * Mapeamento da URL
     * 		http://example.com/index.php/usuarios/cadastrar
     * 	- or -  
     * 		http://example.com/index.php/usuarios/cadastrar
     */
    public function cadastrar()
    {
        $data['pagina'] = "cadastrar";
        $this->load->view('principal/principal', $data);
    }

    /**
     * Metodo index para inclusão da página principal
     *
     * Mapeamento da URL
     * 		http://example.com/index.php/usuarios/gerenciar
     * 	- or -  
     * 		http://example.com/index.php/usuarios/gerenciar
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
     * 		http://example.com/index.php/usuarios/lixeira
     * 	- or -  
     * 		http://example.com/index.php/usuarios/lixeira
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
        $this->usuario = $_POST['usuario'];
        $this->senha = $_POST['senha'];
    }

}

/* End of file usuarios.php */
/* Location: ./application/modules/controllers/usuarios.php */