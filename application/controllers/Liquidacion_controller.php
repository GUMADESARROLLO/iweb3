<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Liquidacion_controller extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Main_model');
        $this->load->model("Liquidacion_model");
        $this->load->library("session");
        if ($this->session->userdata('logged')==0) {

            redirect(base_url() . 'index.php', 'refresh');

        }
    }

    public function seisMeses()
    {
        $data1['liq6mes'] = $this->Liquidacion_model->listar6Meses();
        $this->load->view('header/header');
        $Menu['List_menus'] = $this->Main_model->get_permission();
        $this->load->view('pages/menu',$Menu);
        $this->load->view('pages/6Meses',$data1);
        $this->load->view('footer/footer');
        $this->load->view("jsview/jsLiquidacion");
    }

    public function doceMeses()
    {
        $data2['liq12mes'] = $this->Liquidacion_model->listar12Meses();
        $this->load->view('header/header');
        $Menu['List_menus'] = $this->Main_model->get_permission();
        $this->load->view('pages/menu',$Menu);
        $this->load->view('pages/12Meses',$data2);
        $this->load->view('footer/footer');
        $this->load->view("jsview/jsLiquidacion");
    }

}