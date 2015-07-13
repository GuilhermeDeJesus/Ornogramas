<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UnidadesOrganizacionais extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }

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
        $caracteres = array(".","-");
        $cnpj = str_replace($caracteres, "", $this->input->post('cnpj'));
        $cnpj = filter_var($cnpj, FILTER_SANITIZE_NUMBER_INT);

        if(!empty($this->input->post('name') && !empty($cnpj))){
            $data = array(
                "name" => htmlspecialchars($this->input->post('name')),
                "cnpj" => htmlspecialchars($cnpj),
            );
            $data['sucesso'] = $this->Unidades_Organizacionais_model->create_unidade($data);
        }

        redirect('../../../../', 'refresh');
        // $this->load->view('create_unidades_organizacionais', $data);
    }

    public function unidades_subordinadas($id){

        $id = htmlspecialchars($id);
        $data['unidades'] = $this->Unidades_Organizacionais_model->get_unidades_subordinadas((int) $id);
        $data['unidade'] = $this->Unidades_Organizacionais_model->get_unidade((int) $id);
        $data['all_unidades'] = $this->Unidades_Organizacionais_model->get_unidade();

        $this->load->view('unidades_subordinadas', $data);

    }

    public function get_unidade(){

        $nome = htmlspecialchars($this->input->post('name'));
        $caracteres = array(".","-");
        $cnpj = str_replace($caracteres, "", $this->input->post('cnpj'));
        $cnpj = filter_var($cnpj, FILTER_SANITIZE_NUMBER_INT);
        $data['unidades'] = $this->Unidades_Organizacionais_model->get_unidade(null, (string) $nome, $cnpj);
        $this->load->view('search_unidade', $data);

    }

    public function delete($id){

        $unidades = $this->Unidades_Organizacionais_model->get_filhos($id);
        $array = array();

        if(count($unidades) > 0){

            foreach($unidades as $filhas){
                array_push($array, $filhas->descendant);
            }
        }
        echo count($unidades);
    }

    public function delete_filhos($id){

        $unidades = $this->Unidades_Organizacionais_model->get_filhos((int) $id);
        $filhas = array();

        if(count($unidades) > 0){
            foreach($unidades as $filha){
                array_push($filhas, $filha->descendant);
            }

            $unidades = $this->Unidades_Organizacionais_model->delete_filhos_and_pai($id, $filhas);

        }

        return true;

    }

    public function delete_unidade($id){
        $result = $this->Unidades_Organizacionais_model->delete_unidade($id);
    }

    public function insert_nova_estrutura(){

        $id_pai   = htmlspecialchars($this->input->post('id_pai'));
        $id_filho = htmlspecialchars($this->input->post('id_filho'));

        if((int) $id_filho == 0){
            redirect('../../../../', 'refresh');
        }else{
            $result = $this->Unidades_Organizacionais_model->insert_nova_estrutura((int) $id_pai,
                (int) $id_filho);

            redirect('../../../../', 'refresh');            
        }

    }

    public function download_unidades($id = null){

        $_id = $id;

        $data['unidades'] = $this->Unidades_Organizacionais_model->get_unidade($_id);
        $html = $this->load->view('unidades_download', $data, true);

        $pdf = $this->pdf->load();
        $stylesheet = file_get_contents('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css');
        $pdf->WriteHTML($stylesheet, 1);
        $pdf->WriteHTML($html);
        $arquivo = $pdf->Output('unidades_organizacionais.pdf','I');

        header('Content-Type: application/pdf');
        header('Content-Length: '.strlen( $arquivo ));
        header('Content-disposition: inline; filename=unidades_organizacionais.pdf');
        header('Cache-Control: public, must-revalidate, max-age=0');
        header('Pragma: public');
        header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
        echo $arquivo;
        exit();

    }

    public function editar($id){
        $id = htmlspecialchars($id);
        $data['unidade'] = $this->Unidades_Organizacionais_model->get_unidade($id);
        $data['all_unidades'] = $this->Unidades_Organizacionais_model->get_unidade($id, null, null, 'D');
        $this->load->view('edit', $data);
    }

    public function edit_action($id){

            $id_pai = (int) $id;
            if($this->input->post('id_ancestror') == 0){
                redirect("../../unidades_subordinadas/$id_pai", 'refresh');    
            }else{

                $id_ancestror = $this->input->post('id_ancestror');
                $result = $this->Unidades_Organizacionais_model->edit_estrutura($id_pai, (int) $id_ancestror);

                $this->unidades_subordinadas($id_ancestror);               
            }

    }

    function mask($val, $mask){

         $maskared = '';
         $k = 0;
            for($i = 0; $i<=strlen($mask)-1; $i++)
            {
                 if($mask[$i] == '#'){
                    if(isset($val[$k]))
                     $maskared .= $val[$k++];
                 }else{
                     if(isset($mask[$i]))
                     $maskared .= $mask[$i];
                 }
            }

         return $maskared;
    }



}
