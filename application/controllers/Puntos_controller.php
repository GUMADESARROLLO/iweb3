<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Puntos_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Puntos_model');
        $this->load->library("session");
        if ($this->session->userdata('logged') == 0) {
            redirect(base_url() . 'index.php', 'refresh');
        }
    }
    public function index()
    {
        $data['CLIENTES'] = $this->Puntos_model->listarArticulos();
        $this->load->view('header/header');
        $this->load->view('pages/menu');
        $this->load->view('pages/Puntos',$data);
        $this->load->view('footer/footer');
        $this->load->view('jsview/jsPuntos');
    }
    public function getAllPoint()
    {
        $this->Puntos_model->getAllPoint();
        //$this->db->truncate('mpoint');
        //$rows = array_fill(0, 10, array("1", "2", "3", "4","5","6"));
        //echo json_encode($rows);
        //$this->Puntos_model->insert_rows('mpoint', $rows,false);
    }
}