<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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

/*
 * Classe para retorno de configurações do banco 
 */
class Configuracoes extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /*
     * Retorna a versão do sistema instalado
     */
    public function getVersion()
    {
        $query = $this->db->query("SELECT * FROM version");
        return $query->result();
    }
    
//    public function Dados()
//    {
//        $query = $this->db->query("SELECT * FROM configuracoes");
//        return $query->result();
//    }
//
//    public function Atualizar_version($versao)
//    {
//        $query = $this->db->query("UPDATE version SET version_atual = '" . $versao . "'");
//    }
//
//    public function permissoes()
//    {
//        $query = $this->db->query("SELECT modulos, status FROM modulos WHERE modulos = 'atualizar_sistema' and status = 1");
//        return $query->result();
//    }
}