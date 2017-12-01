<?php
class Usuarios_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getUsuarios()
    {
        $this->db->order_by("DateCreado","desc");
        $query = $this->db->get("usuario");
        if ($query->num_rows()>0) {
            return $query->result_array();
        }
    }

    public function guardarUsuario($Vend,$Empresa,$User,$Pass)
    {
        $data = array(
            "VendedorCod" => $Vend,
            "IDempresa" => $Empresa,
            "Username" => $User,
            "Password" => $Pass,
            "DateCreado" => date("Y-m-d"),
            "privi" => 0
        );
        $query = $this->db->insert('usuario',$data);
        if($query){
            echo true;
        }else{
            echo false;
        }
    }

    public function actualizarPassword($Id,$Pass)
    {
        $data = array(
            "idtblusers" => $Id,
            "Password" => $Pass
        );
        $this->db->where("idtblusers", $Id);
        $query = $this->db->update("usuario",$data);
        if ($query) {
            echo true;
        }
        else {
            echo false;
        }
    }

    public function eliminarUsuario($id)
    {
        $this->db->where("idtblusers", $id);
        $this->db->delete("usuario");
    }
    
}