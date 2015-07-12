<?php
/**
 * Created by PhpStorm.
 * User: Guilherme
 * Date: 07/07/2015
 * Time: 17:09
 */

class Unidades_Organizacionais_model extends CI_Model {

    public $id;
    public $name;
    public $cnpj;

    public function __construct(){
        parent::__construct();
    }

    public function create_unidade($data){

        $this->db->insert('unidades_organizacionais', $data);
        return true;   
        if($this->db->affected_rows() > 0)
        {
            return true; 
        }
    }


    public function get_unidades(){
        $query = $this->db->get('unidades_organizacionais');
        return $query->result();
    }

    public function get_unidades_subordinadas($id_pai){

        $this->db->select('u.id, u.name, u.cnpj');
        $this->db->from('unidades_organizacionais u');
        $this->db->join('unidades_organizacionais_tree_paths t', 'u.id = t.descendant');
        $this->db->where('t.ancestor', $id_pai);
        $this->db->where('u.id != ', $id_pai);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_unidade($id = null, $nome = null, $cnpj = null, $diferente = null){

        if(isset($id) and $id != null){
            // D - diferente
            if($diferente == 'D'){
               $this->db->where('id !=', $id);     
            }else if($diferente == null){   
                $this->db->where('id', $id);
            }
           
        }else if(isset($nome) and $cnpj == null)
        {
            $this->db->where('name', $nome);
        }else if(isset($cnpj) and $nome == null){
            $this->db->where('cnpj', $cnpj);
        }else if(isset($nome) and isset($cnpj)){
            $this->db->where('name', $nome, 'cnpj', $cnpj);
        }

        $query = $this->db->get('unidades_organizacionais');

        return $query->result();
    }

    public function get_filhos($id_pai){

        $sql = null;
        $this->db->where('ancestor', $id_pai);
        $pais = $this->db->get("unidades_organizacionais_tree_paths");

        if(count($pais->result()) > 0){
            return $pais->result();
        }
    }

    public function delete_filhos_and_pai($id, $filhos){

        $this->db->where_in('descendant', $filhos);
        $this->db->delete('unidades_organizacionais_tree_paths');

        $this->db->where('descendant', $id);
        $this->db->delete('unidades_organizacionais_tree_paths');

        $this->delete_unidade($id);
    }

    public function delete_unidade($id){

        $this->db->where('descendant', $id);
        $this->db->delete('unidades_organizacionais_tree_paths');

        $this->db->where("id", $id);
        $this->db->delete('unidades_organizacionais');
        if($this->db->affected_rows() > 0)
        {
            return false;

        }else{

            return false;
        }
    }

    public function insert_nova_estrutura($id_pai, $id_filho){

        $query = $this->db->query("INSERT INTO unidades_organizacionais_tree_paths (ancestor, descendant)
                                    SELECT t.ancestor, $id_filho
                                    FROM unidades_organizacionais_tree_paths AS t
                                    WHERE t.descendant = 11
                                    UNION ALL
                                    SELECT $id_pai, $id_filho");

        return $query;
    }

    public function edit_estrutura($id_pai, $id_acestror){       

        $sql = "INSERT INTO unidades_organizacionais_tree_paths (ancestor, descendant) VALUES ($id_acestror, $id_pai)";

        $query = $this->db->query($sql);

        return $query;
    }

    public function get_pai($ancestror){

        $sql = null;
        $this->db->where('descendant', $ancestror);
        $this->db->where('ancestor != descendant');
        $pais = $this->db->get("unidades_organizacionais_tree_paths");

        return $pais->result();

    }

    

}