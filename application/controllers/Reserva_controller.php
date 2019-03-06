<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reserva_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Main_model');
        $this->load->model('Reserva_model');
        $this->load->library("session");
        if ($this->session->userdata('logged') == 0) {

            redirect(base_url() . 'index.php', 'refresh');

        }
    }
    public function index()
    {
        $data['Articulos'] = $this->Reserva_model->listarArticulos();
        
        $Menu['List_menus'] = $this->Main_model->get_permission();
        $this->load->view('pages/menu',$Menu);

        $this->load->view('header/header');
        $this->load->view('pages/Reserva',$data);
        $this->load->view('footer/footer');
        $this->load->view('jsview/jsReserva');
    }


}