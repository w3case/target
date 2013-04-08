<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuarios extends MX_Controller {

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
        $data['pagina'] = "usuarios"; 
        $this->load->view('principal/principal', $data);
    }

    public function cadastrar()
    {
        $data['pagina'] = "cadastrar"; 
        $this->load->view('principal/principal', $data);
    }

    public function gerenciar()
    {
        $data['pagina'] = "gerenciar"; 
        $this->load->view('principal/principal', $data);
    }

    public function lixeira()
    {
        $data['pagina'] = "lixeira"; 
        $this->load->view('principal/principal', $data);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */