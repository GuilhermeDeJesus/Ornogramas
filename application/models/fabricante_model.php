<?php

class Fabricante_model extends CI_Model {
    
    private $tabela = "fabricante";
    public $codigo;
    public $descricao;
    
    public function __construct(){
        parent::__construct();
    }
    
    public function fetchAll(){
        $query = $this->db->get($this->tabela, 50);
        
        $result = [];
        
        foreach ($query->result() as $row){
            array_push($result, ["descricao" => $row->descricao]);
        }
        
        return $result;
    }
    
    public function insert($data){
        $this->db->insert($this->tabela, $data);
    }
    
    public function getFabricante($id){
        $query = $this->db->get_where($this->tabela, array("codigo" => $id));
        return $query->result();
    }
    
    public function update($id, $data){
      $this->db->where("codigo", $id);   
      $this->db->update($this->tabela, $data);
    }
}