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
        // Code here after successful insert
        return true;   // to the controller
        if($this->db->affected_rows() > 0)
        {
            // Code here after successful insert
            return true; // to the controller
        }
    }


    public function get_unidades(){
        $query = $this->db->get('unidades_organizacionais');
        return $query->result();
    }

    public function get_unidades_subordinadas($id_pai){

        $this->db->select('u.id, u.name, u.cnpj');
        $this->db->from('unidades_organizacionais u');
        $this->db->join('unidades_organizacionais_tree_paths t', 'u.id = t.filho');
        $this->db->where('t.pai', $this->db->escape($id_pai));
        $query = $this->db->get();
        return $query->result();
    }

    public function get_unidade($id = null, $nome = null, $cnpj = null){

        if(isset($id) and $id != null){
            $this->db->where('id', $id);
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
        $this->db->where('pai', $id_pai);
        $pais = $this->db->get("unidades_organizacionais_tree_paths");

        if(count($pais->result()) > 0){
            return $pais->result();
        }
    }

    public function delete_filhos_and_pai($id, $filhos){

        $this->db->where_in('filho', $filhos);
        $this->db->delete('unidades_organizacionais_tree_paths');

        $this->db->where('filho', $id);
        $this->db->delete('unidades_organizacionais_tree_paths');


        $this->delete_unidade($id);

    }

    public function delete_unidade($id){
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

        $query = $this->db->query("INSERT INTO unidades_organizacionais_tree_paths (pai, filho)
                                    SELECT t.pai, $id_filho
                                    FROM unidades_organizacionais_tree_paths AS t
                                    WHERE t.filho = 11
                                    UNION ALL
                                    SELECT $id_pai, $id_filho");

        return $query;
    }

    



}