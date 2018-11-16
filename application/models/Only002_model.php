<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Only002_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function Only002()
    {
        $query = $this->sqlsrv->fetchArray("SELECT * FROM iweb_UMK_EXIST_BODEGA_002", SQLSRV_FETCH_ASSOC);
        $i = 0;
        $json = array();
        foreach ($query as $fila) {
            $json["data"][$i]["LABORATORIO"]            = $fila["LABORATORIO"];
            $json["data"][$i]["ARTICULO"]               = $fila["ARTICULO"];
            $json["data"][$i]["DESCRIPCION"]            = $fila["DESCRIPCION"];
            $json["data"][$i]["CANTIDAD_DISPONIBLE"]      = number_format($fila["CANTIDAD_DISPONIBLE"],2);
            $i++;
        }
        echo json_encode($json);
        $this->sqlsrv->close();
    }
}