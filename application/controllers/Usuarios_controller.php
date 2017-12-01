<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Usuarios_model");
        $this->load->library("session");
        if ($this->session->userdata('logged') == 0) {

            redirect(base_url() . 'index.php', 'refresh');

        }
    }
    
    public function index()
    {
        $data["Usuarios"] = $this->Usuarios_model->getUsuarios();
        $this->load->view('header/header');
        $this->load->view('pages/menu');
        $this->load->view('pages/usuarios',$data);
        $this->load->view('footer/footer');
        $this->load->view('jsview/jsUsuarios');
    }

    public function guardarUser()
    {
        $vend =$this->input->get_post("CodVend");
        $emp = $this->input->get_post("Empresa");
        $user = $this->input->get_post("Username");
        $pass = $this->input->get_post("Password");
        $this->Usuarios_model->guardarUsuario($vend,$emp,$user,$pass);
    }

    public function actualizarPass()
    {   
        $Id = $this->input->get_post("idUser");
        $Pass = $this->input->get_post("newPass");
        $this->Usuarios_model->actualizarPassword($Id,$Pass);
    }

    public function eliminaUser($id)
    {
        $this->Usuarios_model->eliminarUsuario($id);
    }
}