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

/*
 * Classe para retorno de configurações do banco 
 */
class Manutencao extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /*
     * Manutenção do sistema
     */
    public function Reparar($backup = FALSE)
    {
        include_once '../config/config.php';
        $tables = "Tables_in_" . DATABASE;

        // Load the DB utility class
        $this->load->dbutil();

        // otimiza o banco
        $this->dbutil->optimize_database();

        $tabelas = $this->db->query("show tables");
        $result_tabelas = $tabelas->result();

        foreach ($result_tabelas as $tabela)
        {
            // Repara
            $this->dbutil->repair_table($tabela->$tables);

            //otimiza as tabelas
            $this->dbutil->optimize_table($tabela->$tables);
        }

        if ($backup == true)
        {
            $prefs = array(
                'filename' => 'mybackup.sql'
            );

            // Backup your entire database and assign it to a variable
            $backup = & $this->dbutil->backup($prefs);
            $this->load->helper('file');
            write_file('../arquivos/backupSql.zip', $backup);
        }
    }
}