<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Main_model');
        $this->load->library("session");
        if ($this->session->userdata('logged') == 0) {

            redirect(base_url() . 'index.php', 'refresh');

        }
    }
    public function index()
    {
        $data['Articulos'] = $this->Main_model->listarArticulos();
        $this->load->view('header/header');
        $this->load->view('pages/menu');
        $this->load->view('pages/Main',$data);
        $this->load->view('footer/footer');
        $this->load->view('jsview/jsArticulos');
    }

    public function getTransacciones($ID){
        $this->Main_model->getTransaccines($ID);
    }
    public function getTransaccionesDetalles($D1,$D2,$ID){
        $this->Main_model->getTransaccionesDetalles($D1,$D2,$ID);
    }

    public function getBodegas($ID)
    {
        $this->Main_model->getBodegas($ID);
    }

    public function getLotes($bodega,$Art)
    {
        $this->Main_model->getLotes($bodega,$Art);
    }

    public function getPrecios($ID){
        $this->Main_model->getPrecios($ID);
    }

    public function getBonificados($ID)
    {
        $this->Main_model->getBonificados($ID);
    }
}