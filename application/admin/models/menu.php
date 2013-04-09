<?php

class Menu extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function getIdMenu($array)
    {
        $sql = "SELECT * FROM menu WHERE status = 1 AND ";

        foreach ($array as $valor)
        {
            if ($valor != "")
            {
                $sql .= "menuId = $valor OR ";
            }
        }

        $sql = substr($sql, 0, strlen($sql) - 4);
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    public function getQtdMenuPai($array)
    {
        $sql = "SELECT * FROM menu WHERE status = 1 AND ";

        foreach ($array as $valor)
        {
            if ($valor != "")
            {
                $sql .= "menuId = $valor OR ";
            }
        }
        $sql = substr($sql, 0, strlen($sql) - 4);
        $sql .= " group by menuReferencia order by menuNome";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
}