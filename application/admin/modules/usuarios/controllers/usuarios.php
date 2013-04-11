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
    private $nome;
    private $cpf;
    private $nivel;
    private $permissoes;
    
    /*
     * Quantidade de registros
     * pagina: gerenciar
     */
    private $qtdRegistros = 15;

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
        $logs->setLogPath(APPPATH . "logs/" . $this->session->userdata('nome') . "/");
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
        // Gerar Logs
        $this->load->library('my_log');
        $logs = new MY_Log();
        $logs->setLogPath(APPPATH . "logs/" . $this->session->userdata('nome') . "/");
        $logs->write_log('info', "O usuario acessou a área para a listagem dos dados dos usuarios");

        // Redireciona URL para a busca
        if (@$_POST["busca"])
        {
            redirect('usuarios/gerenciar/' . strtolower(url_title(convert_accented_characters($_POST["busca"]))), 'refresh');
        }

        /**
         * Bibliotecas e ajudantes carregados
         * @filesource system/libraries/pagination.php
         * @filesource application/model/crud.php
         */
        $this->load->library('pagination');
        $this->load->model("crud");

        /**
         * Dados passados por Get, para busca
         * Se o segmento 3 existir, o mesmo será passado àos parãmetros
         */
        if ($this->uri->segment(3) == "null")
        {
            $dadosBusca = null;
        }
        else
        {
            $dadosBusca = str_replace("-", " ", $this->uri->segment(3));
        }

        /**
         * Dados passados por Get, para gerar a paginação
         * Se o segmento 4 existir, o mesmo será passado àos parãmetros
         */
        if ($this->uri->segment(4) == "")
        {
            $inicio = 0;
        }
        else
        {
            $inicio = $this->uri->segment(4);
        }

        /*
         * Parâmetros para a busca e retorno dos 
         * dados
         */
        if ($this->uri->segment(3) != "null")
        {
            $parametros = array(
                "select" => "*, DATE_FORMAT(data_acesso,'%d/%m/%Y %H: %i') as dataAcesso",
                "table" => "usuarios",
                "where" => array("lixeira" => 2),
                "like" => array("nome" => $dadosBusca),
                "order_by" => "",
                "group_by" => "",
                "join" => "",
                "orlike" => "",
                "limit" => array($this->qtdRegistros => $inicio)
            );
        }
        else
        {
            $parametros = array(
                "select" => "*, DATE_FORMAT(data_acesso,'%d/%m/%Y %H: %i') as dataAcesso",
                "table" => "usuarios",
                "where" => array("lixeira" => 2),
                "like" => "",
                "order_by" => "",
                "group_by" => "",
                "join" => "",
                "orlike" => "",
                "limit" => array($this->qtdRegistros => $inicio)
            );
        }

        // Metodo para selecionar e retornar os dados 
        // mediante os parametros passados
        $dados = $this->crud->select($parametros, false);

        /*
         * Retorna a quantidade de registros 
         */
        $parametrosCount = array(
                "select" => "*",
                "table" => "usuarios",
                "where" => array("lixeira" => 2),
                "like" => "",
                "limit" => "",
                "order_by" => "",
                "orlike" => "",
                "group_by" => "",
                "join" => ""
            );
        
        $qtdRegistros = $this->crud->select($parametrosCount, false);

        // Parâmetros para a biblioteca de paginação
        $config['base_url'] = base_url() . $this->uri->segment(1) . "/" . $this->uri->segment(2) . "/" . $this->uri->segment(3) . "/";
        $config['total_rows'] = count($qtdRegistros);
        $config['uri_segment'] = 4;
        $config['per_page'] = $this->qtdRegistros;;
        $config['first_tag_open'] = '<li>';
        $config['first_link'] = '<<';
        $config['first_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='active'><a href='javascript:void(0)'>";
        $config['cur_tag_close'] = '</a></li>';
        $config['last_tag_open'] = '<li>';
        $config['last_link'] = '>>';
        $config['last_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_link'] = '>';
        $config['next_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_link'] = '<';
        $config['prev_tag_close'] = '</li>';
        $config['full_tag_open'] = '<div class="pagination pagination-right"><ul>';
        $config['full_tag_close'] = '</ul></div>  ';
        $this->pagination->initialize($config);
        $data['paginacao'] = $this->pagination->create_links();
        $data['dadosbusca'] = $dados;

        // Pagina secundária
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
        $this->nome = $_POST['nome'];
        $this->senha = $_POST['senha'];
        $this->email = $_POST['email'];
        $this->nivel = $_POST['nivel'];
        $this->cpf = $_POST['cpf'];
        $this->permissoes = $_POST['permissoes'];
        $this->cadastrarDados();
    }

    private function cadastrarDados()
    {
        // Função para verificar os campos que estejam vazios
        // Caso algum campo não seja preenchido, a mesma impede 
        // a conclusão da operação
        $campos = array("nome", "senha", "email", "nivel", "cpf");
        verificarCampos($campos);

        // Verifica CPF
        if (!validaCPF($_POST['cpf']))
        {
            echo '<div class="alert alert-error">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <h4>Erro!</h4>CPF inválido, Por favor, verifique o campos destinado a este dado.
                  </div>';
            exit;
        }

        // Verifica se a senha é maior que 6 digitos e se as duas são iguais
        if ($_POST['senha'] != $_POST['repetirSenha'] || strlen($_POST['repetirSenha']) < 6)
        {
            echo '<div class="alert alert-error">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <h4>Erro!</h4>Senha redigitada não confere ou contém menos de 6 caracteres
                  </div>';
            exit;
        }

        /*
         * Carrega a classe Crud
         * /application/model/crud.php
         */
        $this->load->model("crud");

        // Armazena as permissões em uma variável
        $permissao = "";
        foreach ($this->permissoes as $pm):
            $permissao .= $pm . ",";
        endforeach;

        /*
         * Armazena os dados em um vetor
         * para serem enviados ao banco
         */
        $array = array(
            "senha" => md5($_POST['senha']),
            "nome" => $_POST['nome'],
            "email" => $_POST['email'],
            "cpf" => $_POST['cpf'],
            "tipo" => $_POST['nivel'],
            "status" => 1,
            "lixeira" => 2,
            "permissoes" => $permissao,
            "ip_acesso" => $_SERVER['REMOTE_ADDR'],
            "data_acesso" => date('Y-m-d H:i:s')
        );

        // Retorna o ID da ultima inserção ou o numero do erro
        $retorno = $this->crud->insert("usuarios", $array);

        if ($retorno == 1062)
        {
            echo '<div class="alert alert-error">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <h4>Erro!</h4>O usuário já está cadastrado. Por favor, utilize um email não cadastrado.
                  </div>';
            exit;
        }

        // Mensagem de sucesso
        if ($retorno)
        {
            // Gerar Logs
            $this->load->library('my_log');
            $logs = new MY_Log();
            $logs->setLogPath(APPPATH . "logs/" . $retorno[0]->nome . "/");
            $logs->write_log('info', "O usuario cadastrou um novo usuário: " . $_POST['nome']);

            $mensagem = array('mensagem' => '<div class="alert alert-success">
                                           <button type="button" class="close" data-dismiss="alert">&times;</button>
                                           <h4>Sucesso!</h4>Usuário cadastrado
                                           </div>');
            $this->session->set_userdata($mensagem);
            print "<script>self.location = '" . base_url() . "usuarios/cadastrar'</script>";
        }
        else
        {
            echo '<div class="alert alert-error">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <h4>Erro!</h4>O usuário não pode ser cadastrado
                  </div>';
            exit;
        }
    }

}

/* End of file usuarios.php */
/* Location: ./application/modules/controllers/usuarios.php */