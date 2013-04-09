<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * Classe principal.
 * Esta será chamada quando o sistema for carregada a primeira vez
 */

class Usuario extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logado') == true)
        {
            if ($this->session->userdata('usuario_modulo') != true)
            {
                // Verifica se o usuário tem acesso a determinado menu do site
                $this->load->model("crud");
                $link = $this->uri->uri_string();
                $array = array('menuLink' => $link);
                $retorno = $this->crud->mostrar_onde("menu", $array);

                if (!array_search($retorno[0]->menuId, $this->session->userdata('menu')))
                {
                    print "<script>self.location = '" . base_url() . "admin.php/acesso_negado'</script>";
                }
                else
                {
                    // Dados para autenticação
                    $array = array(
                        'usuario_modulo' => true,
                    );
                    $this->session->set_userdata($array);
                }
            }

            $this->load->model('configuracoes');
            $dados = $this->configuracoes->dados();
            // Time zone (Ver constants em /config)
            date_default_timezone_set($dados[0]->timezone);
        }
        else
        {
            // Redireciona se nao houver uma sessao aberta para o usuario
            print "<script>self.location = '" . base_url() . "admin.php/login'</script>";
        }
    }

    public function Index()
    {
        // Logs do sistema
        $this->load->library('logs');
        $config = array(
            'path' => 'application/admin/logs/' . $this->session->userdata('nome') . '/',
            'tipo' => 'xml',
            'arquivo' => date('d-m-Y')
        );
        $this->logs->inicialize($config);
        $this->logs->Gerarlog('O usuario acessou menu cadastrar usuários');

        $this->load->model('crud');
        $this->load->model('configuracoes');
        $versao = $this->configuracoes->version();
        if ($versao[0]->version != $versao[0]->version_atual)
        {
            $data['nova_versao'] = '<a href="admin.php/atualizar_sistema">Nova atualização ' . $versao[0]->version_atual . ' Disponível</a>';
        }
        else
        {
            $data['nova_versao'] = "";
        }

        $data['menu'] = Montamenu($this->configuracoes->montamenu($this->session->userdata('menu')));
        $data['queryMenus'] = $this->crud->mostrar_onde("menu", array("menuReferencia" => $this->uri->segment(1), "menuIdPai !=" => 0));

        $data['tema'] = $this->session->userdata('tema');
        $data['permissoes'] = $this->configuracoes->montamenu($this->session->userdata('menu'));
        $data['version'] = $versao[0]->version;
        $this->load->view('usuario', $data);
    }

    public function Cadastrar()
    {
        // Logs do sistema
        $this->load->library('logs');
        $config = array(
            'path' => 'application/admin/logs/' . $this->session->userdata('nome') . '/',
            'tipo' => 'xml',
            'arquivo' => date('d-m-Y')
        );
        $this->logs->inicialize($config);
        $this->logs->Gerarlog('O usuario acessou menu cadastrar usuários');

        $this->load->model('crud');
        $this->load->model('configuracoes');
        $versao = $this->configuracoes->version();
        if ($versao[0]->version != $versao[0]->version_atual)
        {
            $data['nova_versao'] = '<a href="admin.php/atualizar_sistema">Nova atualização ' . $versao[0]->version_atual . ' Disponível</a>';
        }
        else
        {
            $data['nova_versao'] = "";
        }

        $data['menu'] = Montamenu($this->configuracoes->montamenu($this->session->userdata('menu')));
        $data['queryMenus'] = $this->crud->mostrar_onde("menu", array("menuReferencia" => $this->uri->segment(1), "menuIdPai !=" => 0));

        $data['tema'] = $this->session->userdata('tema');
        $data['permissoes'] = $this->configuracoes->montamenu($this->session->userdata('menu'));
        $data['version'] = $versao[0]->version;
        $this->load->view('usuario', $data);
    }

    public function Editar($id)
    {
        // Logs do sistema
        $this->load->library('logs');
        $config = array(
            'path' => 'application/admin/logs/' . $this->session->userdata('nome') . '/',
            'tipo' => 'xml',
            'arquivo' => date('d-m-Y')
        );
        $this->logs->inicialize($config);
        $this->logs->Gerarlog('O usuario enviu o usuario com id ' . $id . ' para a área de edição');

        $this->load->model('crud');
        $this->load->model('configuracoes');
        $versao = $this->configuracoes->version();
        if ($versao[0]->version != $versao[0]->version_atual)
        {
            $data['nova_versao'] = '<a href="admin.php/atualizar_sistema">Nova atualização ' . $versao[0]->version_atual . ' Disponível</a>';
        }
        else
        {
            $data['nova_versao'] = "";
        }

        $data['menu'] = Montamenu($this->configuracoes->montamenu($this->session->userdata('menu')));
        $data['queryMenus'] = $this->crud->mostrar_onde("menu", array("menuReferencia" => $this->uri->segment(1), "menuIdPai !=" => 0));

        $data['dados'] = $this->crud->mostrar_onde("usuarios", array("id" => $id));
        $data['permissoes'] = $this->configuracoes->montamenu($this->session->userdata('menu'));
        $data['version'] = $versao[0]->version;
        $data['tema'] = $this->session->userdata('tema');
        if ($this->session->userdata('tipo') <= 2)
        {
            $this->load->view('usuario', $data);
        }
        else
        {
            $this->load->view('erro', $data);
        }
    }

    public function Gerenciar()
    {
        //Configurações
        $this->load->model('configuracoes');
        $configuracoes = $this->configuracoes->dados();

        // Logs do sistema
        $this->load->library('logs');
        $config = array(
            'path' => 'application/admin/logs/' . $this->session->userdata('nome') . '/',
            'tipo' => 'xml',
            'arquivo' => date('d-m-Y')
        );
        $this->logs->inicialize($config);
        $this->logs->Gerarlog('O usuario acessou o menu gerenciar usuários');

        //Model Curd
        $this->load->model("crud");

        //Busca
        if ($_SERVER['REQUEST_METHOD'] == "POST")
        {
            if ($_POST['usuario'] == "")
            {
                $parametro_1 = "null";
            }
            else
            {
                $parametro_1 = $_POST['usuario'];
            }
            if ($_POST['tipo'] == "")
            {
                $parametro_2 = "null";
            }
            else
            {
                $parametro_2 = $_POST['tipo'];
            }
            print "<script>self.location = '" . base_url() . "admin.php/usuario/gerenciar/" . $parametro_1 . "/" . $parametro_2 . "/'</script>";
        }

        $this->load->model('configuracoes');
        $versao = $this->configuracoes->version();
        if ($versao[0]->version != $versao[0]->version_atual)
        {
            $data['nova_versao'] = '<a href="admin.php/atualizar_sistema">Nova atualização ' . $versao[0]->version_atual . ' Disponível</a>';
        }
        else
        {
            $data['nova_versao'] = "";
        }

        $data['menu'] = Montamenu($this->configuracoes->montamenu($this->session->userdata('menu')));
        $data['queryMenus'] = $this->crud->mostrar_onde("menu", array("menuReferencia" => $this->uri->segment(1), "menuIdPai !=" => 0));

        // Paginacao
        $this->load->model("paginacao");
        $this->load->library('pagination');
        $maximo = $configuracoes[0]->width_not;
        if ($this->uri->segment(5) == "")
        {
            $inicio = 0;
        }
        else
        {
            $inicio = $this->uri->segment(5);
        }

        // Dados busca
        if ($this->uri->segment(3) == "null")
        {
            $busca_1 = null;
        }
        else
        {
            $busca_1 = $this->uri->segment(3);
        }
        if ($this->uri->segment(4) == "null")
        {
            $busca_2 = null;
        }
        else
        {
            $busca_2 = $this->uri->segment(4);
        }
        $busca = array("nome" => $busca_1, "tipo" => $busca_2);

        $config['base_url'] = base_url() . "admin.php/" . $this->uri->segment(1) . "/" . $this->uri->segment(2) . "/" . $this->uri->segment(3) . "/" . $this->uri->segment(4) . "/";
        $config['total_rows'] = $this->paginacao->contaRegistros($busca);
        $config['uri_segment'] = 5;
        $config['per_page'] = $maximo;
        $config['first_link'] = 'Primeiro';
        $config['cur_tag_open'] = "<div>";
        $config['cur_tag_close'] = '</div>';
        $config['last_link'] = '&Uacute;ltimo';
        $config['next_link'] = 'Pr&oacute;ximo';
        $config['prev_link'] = 'Anterior';
        $config['full_tag_open'] = '<div class="paginacao_fundo">';
        $config['full_tag_close'] = '</div>';
        $this->pagination->initialize($config);
        $data['paginacao'] = $this->pagination->create_links();
        $data['dadosbusca'] = $this->paginacao->retornaLista($maximo, $inicio, $busca);

        $data['tema'] = $this->session->userdata('tema');
        $data['version'] = $versao[0]->version;
        $this->load->view('usuario', $data);
    }

    public function Lixeira()
    {
        //Configurações
        $this->load->model('configuracoes');
        $configuracoes = $this->configuracoes->dados();
        
        //Crud
        $this->load->model('crud');

        // Logs do sistema
        $this->load->library('logs');
        $config = array(
            'path' => 'application/admin/logs/' . $this->session->userdata('nome') . '/',
            'tipo' => 'xml',
            'arquivo' => date('d-m-Y')
        );
        $this->logs->inicialize($config);
        $this->logs->Gerarlog('O usuario acessou o menu lixeira');

        //Busca
        if ($_SERVER['REQUEST_METHOD'] == "POST")
        {
            if ($_POST['usuario'] == "")
            {
                $parametro_1 = "null";
            }
            else
            {
                $parametro_1 = $_POST['usuario'];
            }
            if ($_POST['tipo'] == "")
            {
                $parametro_2 = "null";
            }
            else
            {
                $parametro_2 = $_POST['tipo'];
            }
            print "<script>self.location = '" . base_url() . "admin.php/usuario/lixeira/" . $parametro_1 . "/" . $parametro_2 . "/'</script>";
        }

        $this->load->model('configuracoes');
        $versao = $this->configuracoes->version();
        if ($versao[0]->version != $versao[0]->version_atual)
        {
            $data['nova_versao'] = '<a href="admin.php/atualizar_sistema">Nova atualização ' . $versao[0]->version_atual . ' Disponível</a>';
        }
        else
        {
            $data['nova_versao'] = "";
        }

        $data['menu'] = Montamenu($this->configuracoes->montamenu($this->session->userdata('menu')));
        $data['queryMenus'] = $this->crud->mostrar_onde("menu", array("menuReferencia" => $this->uri->segment(1), "menuIdPai !=" => 0));

        // Paginacao
        $this->load->model("paginacao");
        $this->load->library('pagination');
        $maximo = $configuracoes[0]->width_not;
        if ($this->uri->segment(5) == "")
        {
            $inicio = 0;
        }
        else
        {
            $inicio = $this->uri->segment(5);
        }

        // Dados busca
        if ($this->uri->segment(3) == "null")
        {
            $busca_1 = null;
        }
        else
        {
            $busca_1 = $this->uri->segment(3);
        }
        if ($this->uri->segment(4) == "null")
        {
            $busca_2 = null;
        }
        else
        {
            $busca_2 = $this->uri->segment(4);
        }
        $busca = array("nome" => $busca_1, "tipo" => $busca_2);

        $config['base_url'] = base_url() . "admin.php/" . $this->uri->segment(1) . "/" . $this->uri->segment(2) . "/" . $this->uri->segment(3) . "/" . $this->uri->segment(4) . "/";
        $config['total_rows'] = $this->paginacao->contaRegistroslx($busca);
        $config['uri_segment'] = 5;
        $config['per_page'] = $maximo;
        $config['first_link'] = 'Primeiro';
        $config['cur_tag_open'] = "<div>";
        $config['cur_tag_close'] = '</div>';
        $config['last_link'] = '&Uacute;ltimo';
        $config['next_link'] = 'Pr&oacute;ximo';
        $config['prev_link'] = 'Anterior';
        $config['full_tag_open'] = '<div class="paginacao_fundo">';
        $config['full_tag_close'] = '</div>';
        $this->pagination->initialize($config);
        $data['paginacao'] = $this->pagination->create_links();
        $data['dadosbusca'] = $this->paginacao->retornaListalx($maximo, $inicio, $busca);

        $data['tema'] = $this->session->userdata('tema');
        $data['version'] = $versao[0]->version;
        $this->load->view('usuario', $data);
    }

    public function action_cadastrar()
    {
        // Função para verificar os campos que estejam vazios
        $campos = array(
            "nome" => "nome",
            "senha" => "senha",
            "cpf" => "cpf",
            "tipo" => "tipo"
        );
        verificar_campos($campos);

        // Verifica CPF
        if (!validaCPF($_POST['cpf']))
        {
            MsgError("ERRO", "CPF inv&aacute;lido");
            exit;
        }

        // Verifica Senha
        if ($_POST['senha'] != $_POST['senha2'])
        {
            MsgError("ERRO", "As Senhas não conferem");
            exit;
        }

        // LE o model
        $this->load->model("crud");

        $permissao = "";

        foreach ($_POST['itensmenu'] as $pm):
            $permissao .= $pm . ",";
        endforeach;

        // Função para verificar os campos que estejam vazios
        $array = array(
            "senha" => md5($_POST['senha']),
            "nome" => $_POST['nome'],
            "email" => $_POST['email'],
            "cpf" => $_POST['cpf'],
            "tipo" => $_POST['tipo'],
            "status" => 1,
            "lixeira" => 1,
            "permissoes" => $permissao,
            "ip_acesso" => $_SERVER['REMOTE_HOST'],
            "data_acesso" => date('Y-m-d H:i:s')
        );

        if ($this->crud->inserir("usuarios", $array))
        {
            // Logs do sistema
            $this->load->library('logs');
            $config = array(
                'path' => 'application/admin/logs/' . $this->session->userdata('nome') . '/',
                'tipo' => 'xml',
                'arquivo' => date('d-m-Y')
            );
            $this->logs->inicialize($config);
            $this->logs->Gerarlog('O usuario ' . $this->session->userdata('nome') . ' cadastrou um novo usuário chamado ' . $_POST['nome'] . '');

            MsgError("SUCESSO", "Cadastrado com sucesso");
            echo '<script>$("#usuarios").resetForm();</script>';
        }
        else
        {
            MsgError("ERRO", "Erro ao cadastrar usu&aacute;rio");
        }
    }

    /*
     * Metodos para manibular dados
     * Excluir, mudar status e enviar para a lixeira
     */

    public function Excluir($id = "")
    {
        $this->load->model("crud");

        $array = array(
            "id" => $id
        );

        if ($this->crud->deletar("usuarios", "id", $array))
        {
            // Logs do sistema
            $this->load->library('logs');
            $config = array(
                'path' => 'application/admin/logs/' . $this->session->userdata('nome') . '/',
                'tipo' => 'xml',
                'arquivo' => date('d-m-Y')
            );
            $this->logs->inicialize($config);
            $this->logs->Gerarlog('O usuario excluiu o usuário com  id ' . $id);
        }
        else
        {
            MsgError("ERRO", "Erro ao deletar. Tente novamente, se o problema continuar, contate o administrador");
        }
    }

    public function enviar_lixeira($id = "")
    {
        $this->load->model("crud");

        $array = array(
            "lixeira" => 2,
            "id" => $id
        );

        if ($this->crud->atualizar("usuarios", "id", $array))
        {
            // Logs do sistema
            $this->load->library('logs');
            $config = array(
                'path' => 'application/admin/logs/' . $this->session->userdata('nome') . '/',
                'tipo' => 'xml',
                'arquivo' => date('d-m-Y')
            );
            $this->logs->inicialize($config);
            $this->logs->Gerarlog('O usuario enviu o usuario com id ' . $id . ' para a lixeira');
        }
        else
        {
            MsgError("ERRO", "Erro ao deletar. Tente novamente, se o problema continuar, contate o administrador");
        }
    }

    public function restaurar($id = "")
    {
        $this->load->model("crud");

        $array = array(
            "lixeira" => 1,
            "id" => $id
        );

        if ($this->crud->atualizar("usuarios", "id", $array))
        {
            // Logs do sistema
            $this->load->library('logs');
            $config = array(
                'path' => 'application/admin/logs/' . $this->session->userdata('nome') . '/',
                'tipo' => 'xml',
                'arquivo' => date('d-m-Y')
            );
            $this->logs->inicialize($config);
            $this->logs->Gerarlog('O usuario restaurou da lixeira o usuario com id ' . $id);
        }
        else
        {
            MsgError("ERRO", "Erro ao deletar. Tente novamente, se o problema continuar, contate o administrador");
        }
    }

    public function Status($id, $status)
    {
        // Logs do sistema
        $this->load->library('logs');
        $config = array(
            'path' => 'application/admin/logs/' . $this->session->userdata('nome') . '/',
            'tipo' => 'xml',
            'arquivo' => date('d-m-Y')
        );
        $this->logs->inicialize($config);
        $this->logs->Gerarlog('O usuario mudou o status do usuario com id ' . $id);

        $this->load->model("crud");
        $array = array(
            "id" => $id,
            "status" => $status
        );
        $this->crud->atualizar("usuarios", "id", $array);
    }

    public function action_atualizar()
    {
        // Função para verificar os campos que estejam vazios
        $campos = array(
            "nome" => "nome",
            "cpf" => "cpf",
            "tipo" => "tipo"
        );
        verificar_campos($campos);

        // Verifica CPF
        if (!validaCPF($_POST['cpf']))
        {
            MsgError("ERRO", "CPF inv&aacute;lido");
            exit;
        }

        // Verifica Senha
        if ($_POST['senha'] || $_POST['senha2'])
        {
            if ($_POST['senha'] != $_POST['senha2'])
            {
                MsgError("ERRO", "As Senhas não conferem");
                exit;
            }
        }

        // LE o model
        $this->load->model("crud");

        $permissao = "";

        foreach ($_POST['itensmenu'] as $pm):
            $permissao .= $pm . ",";
        endforeach;

        if (empty($_POST['senha']))
        {
            // Função para verificar os campos que estejam vazios
            $array = array(
                "id" => $_POST['id'],
                "nome" => $_POST['nome'],
                "email" => $_POST['email'],
                "cpf" => $_POST['cpf'],
                "tipo" => $_POST['tipo'],
                "permissoes" => $permissao,
                "ip_acesso" => $_SERVER['REMOTE_HOST'],
                "data_acesso" => date('Y-m-d H:i:s')
            );
        }
        else
        {
            // Função para verificar os campos que estejam vazios
            $array = array(
                "id" => $_POST['id'],
                "senha" => md5($_POST['senha']),
                "nome" => $_POST['nome'],
                "email" => $_POST['email'],
                "cpf" => $_POST['cpf'],
                "tipo" => $_POST['tipo'],
                "permissoes" => $permissao,
                "ip_acesso" => $_SERVER['REMOTE_HOST'],
                "data_acesso" => date('Y-m-d H:i:s')
            );
        }

        if ($this->crud->atualizar("usuarios", "id", $array))
        {
            // Logs do sistema
            $this->load->library('logs');
            $config = array(
                'path' => 'application/admin/logs/' . $this->session->userdata('nome') . '/',
                'tipo' => 'xml',
                'arquivo' => date('d-m-Y')
            );
            $this->logs->inicialize($config);
            $this->logs->Gerarlog('O usuario ' . $this->session->userdata('nome') . ' atualizaou o usuário chamado ' . $_POST['usuario'] . '');

            MsgError("SUCESSO", "Atualizado com sucesso");
        }
        else
        {
            MsgError("ERRO", "Erro ao atualizar usu&aacute;rio");
        }
    }

}
