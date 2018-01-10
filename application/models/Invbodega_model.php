<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invbodega_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function lst_bodegas()
    {
        $query = $this->sqlsrv->fetchArray("SELECT * FROM iweb_lst_bodega",SQLSRV_FETCH_ASSOC);
        if($query){return $query;}
        $this->sqlsrv->close();
    }
    public function getInvBodegas($ID)
    {
            $query = $this->sqlsrv->fetchArray("SELECT * FROM iweb_invbodega WHERE BODEGA = '$ID'", SQLSRV_FETCH_ASSOC);
        $i = 0;
        $json = array();
        foreach ($query as $fila) {
            $json["data"][$i]["ARTICULO"] = $fila["ARTICULO"];
            $json["data"][$i]["NOMBRE"] = $fila["DESCRIPCION"];
            $json["data"][$i]["LABORATORIO"] = $fila["LABORATORIO"];
            $json["data"][$i]["BODEGA"] = $fila["BODEGA"];
            $json["data"][$i]["LOTE"] = $fila["LOTE"];
            $json["data"][$i]["CANT_DISPONIBLE"] = number_format($fila["CANT_DISPONIBLE"],2);
            $json["data"][$i]["FECHA_ENTRADA"] = $fila["FECHA_ENTRADA"];
            $json["data"][$i]["FECHA_VENCIMIENTO"] = $fila["FECHA_VENCIMIENTO"];
            $i++;
        }
        echo json_encode($json);
        $this->sqlsrv->close();
    }
}