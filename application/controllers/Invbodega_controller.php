<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invbodega_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Main_model');
        $this->load->model('Invbodega_model');
        $this->load->library("session");
        if ($this->session->userdata('logged') == 0) {

            redirect(base_url() . 'index.php', 'refresh');

        }
    }
    public function index()
    {
        $data['lstBodega'] = $this->Invbodega_model->lst_bodegas();
        $this->load->view('header/header');
        $Menu['List_menus'] = $this->Main_model->get_permission();
        $this->load->view('pages/menu',$Menu);
        $this->load->view('pages/Invbodega',$data);
        $this->load->view('footer/footer');
        $this->load->view('jsview/jsInvbodega');
    }

    public function getInvBodegas($id)
    {
       $this->Invbodega_model->getInvBodegas($id);
    }



}