<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UnidadesOrganizacionais extends CI_Controller {


    public function index()
    {
        $data['unidades'] = $this->Unidades_Organizacionais_model->get_unidades();

        $this->load->view('unidades_organizacionais', $data);
    }

    public function create_unidades()
    {
        $this->load->view('create_unidades_organizacionais');
    }

    public function create()
    {
        $data = array();
        if(!empty($this->input->post('name') && !empty($this->input->post('cnpj')))){
            $data = array(
                "name" => htmlspecialchars($this->input->post('name')),
                "cnpj" => htmlspecialchars($this->input->post('cnpj')),
            );
            $data['sucesso'] = $this->Unidades_Organizacionais_model->create_unidade($data);
        }

        $this->load->view('create_unidades_organizacionais', $data);
    }

    public function unidades_subordinadas($id){


        $data['unidades'] = $this->Unidades_Organizacionais_model->get_unidades_subordinadas((int) $id);
        $data['unidade'] = $this->Unidades_Organizacionais_model->get_unidade((int) $id);
        $data['all_unidades'] = $this->Unidades_Organizacionais_model->get_unidade();

        $this->load->view('unidades_subordinadas', $data);

    }

    public function get_unidade(){

        $nome = htmlspecialchars($this->input->post('name'));
        $cnpj = htmlspecialchars($this->input->post('cnpj'));

        $data['unidades'] = $this->Unidades_Organizacionais_model->get_unidade(null, (string) $nome, (int) $cnpj);

        $this->load->view('unidades_organizacionais', $data);

    }

    public function delete($id){

        $unidades = $this->Unidades_Organizacionais_model->get_filhos($id);
        $array = array();

        if(count($unidades) > 0){

            foreach($unidades as $filhas){
                array_push($array, $filhas->filho);
            }
        }
        echo count($unidades);
    }

    public function delete_filhos($id){

        $unidades = $this->Unidades_Organizacionais_model->get_filhos((int) $id);
        $filhas = array();

        if(count($unidades) > 0){
            foreach($unidades as $filha){
                array_push($filhas, $filha->filho);
            }

            $unidades = $this->Unidades_Organizacionais_model->delete_filhos_and_pai($id, $filhas);

        }

        return true;

    }

    public function delete_unidade($id){
        $result = $this->Unidades_Organizacionais_model->delete_unidade($id);
    }

    public function insert_nova_estrutura(){

        $id_pai = htmlspecialchars($this->input->post('id_pai'));
        $id_filho = htmlspecialchars($this->input->post('id_filho'));

        $result = $this->Unidades_Organizacionais_model->insert_nova_estrutura((int) $id_pai,
            (int) $id_filho);

        $this->unidades_subordinadas($id_pai);

    }

    public function edit_estrutura(){
        $this->load->view('edit');
    }

}
