<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stat_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Main_model');
        $this->load->model('Stat_model');
        $this->load->library("session");
        if ($this->session->userdata('logged') == 0) {

            redirect(base_url() . 'index.php', 'refresh');

        }
    }
    public function index()
    {        
        $this->load->view('header/header');
        $Menu['List_menus'] = $this->Main_model->get_permission();
        $this->load->view('pages/menu',$Menu);
        $this->load->view('pages/Stat');
        $this->load->view('footer/footer');
        $this->load->view('jsview/jsStat');
    }
    public function getStat()
    {
        $this->Stat_model->getStat();
    }
}