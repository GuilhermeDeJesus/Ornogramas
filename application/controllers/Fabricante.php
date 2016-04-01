<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Fabricante extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model("Fabricante_model");
        $this->load->library('form_validation');
    }
    
    public function index(){
        
        $data['fabricantes'] = (array) $this->Fabricante_model->fetchAll();
        
        echo "<pre>";
        
        print_r($this->Fabricante_model->fetchAll());die;
        
        $this->load->view("fabricante_index", $data);
    }
    
    public function insert(){
        $data = array(
            "descricao" => $this->input->post("descricao")
        );
        
        $this->Fabricante_model->insert($data);
        $this->index();
    }
    
    public function edit($id){
        $data['fabricante'] = $this->Fabricante_model->getFabricante($id);
        $this->load->view("edit", $data);
    }
    
    public function update($id){
        
        $data = array(
            "descricao" => $this->input->post("descricao")
        );
        
        $this->Fabricante_model->update($id, $data);
        $this->index();
    }
    
}