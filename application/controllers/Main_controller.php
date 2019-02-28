<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Main_model');
        $this->load->model('Only002_model');
        $this->load->model('Catalogo_model');
        $this->load->model('DispClientes_model');
        $this->load->library("session");
        if ($this->session->userdata('logged') == 0) {
            redirect(base_url() . 'index.php', 'refresh');
        }
    }
    public function index()
    {

        $data['Articulos'] = $this->Main_model->listarArticulos();
        $data['hideTransaccion']=($this->session->userdata('RolUser')!='2') ? '' : 'hide_transaccion';
        $this->load->view('header/header');
        $Menu['List_menus'] = $this->Main_model->get_permission();
        $this->load->view('pages/menu',$Menu);
        $this->load->view('pages/Main',$data);
        $this->load->view('footer/footer');
        $this->load->view('jsview/jsArticulos');
    }
    public function main2()
    {
        $data['Articulos'] = $this->Main_model->listarArticulos();
        $data['hideTransaccion']=($this->session->userdata('RolUser')!='2') ? '' : 'hide_transaccion';
        $this->load->view('header/header');
        $Menu['List_menus'] = $this->Main_model->get_permission();
        $this->load->view('pages/menu',$Menu);
        $this->load->view('pages/Inventario',$data);
        $this->load->view('footer/footer');
        $this->load->view('jsview/jsArticulos');
    }
    public function main_clean()
    {

        $this->load->view('header/header');
        $Menu['List_menus'] = $this->Main_model->get_permission();
        $this->load->view('pages/menu',$Menu);
        $this->load->view('pages/Main_clean');
        $this->load->view('footer/footer');
        $this->load->view('jsview/jsArticulos');
    }
    public function only002()
    {
       // $data['Articulos'] = $this->Only002_model->Only002();
        $this->load->view('header/header');
        $Menu['List_menus'] = $this->Main_model->get_permission();
        $this->load->view('pages/menu',$Menu);
        $this->load->view('pages/Only002');
        $this->load->view('footer/footer');
        $this->load->view('jsview/jsOnly002');
    }
    public function Catalogos()
    {
        // $data['Articulos'] = $this->Only002_model->Only002();
        $this->load->view('header/header');
        $Menu['List_menus'] = $this->Main_model->get_permission();
        $this->load->view('pages/menu',$Menu);
        $this->load->view('pages/Catalogos');
        $this->load->view('footer/footer');
        $this->load->view('jsview/jsCatalogos');
    }
    public function ajax_Catalogos() {
        $this->Catalogo_model->ajax_Catalogos();
    }
    public function Disp_Clientes()
    {
        // $data['Articulos'] = $this->Only002_model->Only002();
        $this->load->view('header/header');
        $Menu['List_menus'] = $this->Main_model->get_permission();
        $this->load->view('pages/menu',$Menu);
        $this->load->view('pages/Disp_Clientes');
        $this->load->view('footer/footer');
        $this->load->view('jsview/jsDispClientes');
    }
    public function ajax_Disp_Clientes() {
        $this->DispClientes_model->ajax_Disp_Clientes();
    }
    public function ajax_only002() {
        $this->Only002_model->Only002();
    }
    public function lst_ajax_Modulos($id) {
        $this->Main_model->lst_ajax_Modulos($id);
    }

    public function get_ajx_item($C){
        $this->Main_model->get_ajx_item($C);
    }

    public function getTransacciones($ID){
        $this->Main_model->getTransaccines($ID);
    }
    public function getTransaccionesDetalles($D1,$D2,$ID,$TP){
        $this->Main_model->getTransaccionesDetalles($D1,$D2,$ID,$TP);
    }
    public function getIngresos($ARTICULO,$LOTE){
        $this->Main_model->getIngresos($ARTICULO,$LOTE);
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
    public function lst_ajax_SavePermisos() {
        $this->Main_model->lst_ajax_SavePermisos(
            $this->input->post('gpUsu'),
            $this->input->post('gpMod')
        );
    }
}