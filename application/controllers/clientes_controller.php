<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class clientes_controller extends CI_Controller {
    public function __construct() {
        parent::__construct();

        $this->load->model('Main_model');
        $this->load->model('cliente_model');
        
        if ($this->session->userdata('logged') == 0) {
            redirect(base_url() . 'index.php', 'refresh');
        }
    }

    public function index($ID_CLIENTE) {
        $data['dt_c'] = $this->cliente_model->detalleCliente( $ID_CLIENTE );

        $this->load->view('header/header');
        $Menu['List_menus'] = $this->Main_model->get_permission();
        $this->load->view('pages/menu',$Menu);
        $this->load->view('pages/detalleCliente', $data);
        $this->load->view('footer/footer');
        $this->load->view('jsview/jsClientes');
    }

    public function changeTabs( $TIPO, $ID_CLIENTE) {
        $this->cliente_model->retornaData($TIPO, $ID_CLIENTE);
    }

    public function detalleFactura( $ID_DOC ) {
        $this->cliente_model->retornaDetalleFactura($ID_DOC);
    }

    public function detalleCanje( $ID_CANJ ) {
        $this->cliente_model->retornaDetalleCanje($ID_CANJ);
    }
}