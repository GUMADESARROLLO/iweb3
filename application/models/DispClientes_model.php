<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DispClientes_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function ajax_Disp_Clientes()
    {

        $query = $this->sqlsrv->fetchArray("SELECT * FROM SAC_DISP_CREDITO_UMK", SQLSRV_FETCH_ASSOC);
        $i = 0;
        $json = array();
        foreach ($query as $fila) {
            $json["data"][$i]["MOROSO"]              = $fila["MOROSO"];
            $json["data"][$i]["CLIENTE"]             = '<a href="clientes/'.$fila["CLIENTE"].'">'.$fila["CLIENTE"].'</a>';
            $json["data"][$i]["NOMBRE"]              = $fila["NOMBRE"];
            $json["data"][$i]["LIMITE_CREDITO"]      = "C$ ".number_format($fila["LIMITE_CREDITO"],2);
            $json["data"][$i]["SALDO"]               = "C$ ".number_format($fila["SALDO"],2);
            $json["data"][$i]["ESTADOACTUAL"]        = $fila["ESTADOACTUAL"];
            $json["data"][$i]["CREDITODISP"]         = "C$ ".number_format($fila["CREDITODISP"],2);
            $json["data"][$i]["VENDEDOR"]            = $fila["VENDEDOR"];
            $json["data"][$i]["DIRECCION"]           = $fila["DIRECCION"];
            $i++;
        }
        echo json_encode($json);
        $this->sqlsrv->close();
    }

}