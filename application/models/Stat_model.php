<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stat_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getStat()
    {
        $query = $this->sqlsrv->fetchArray("SELECT * FROM iweb_UMK_PROMEDIO_ANUAL_POR_ARTICULO", SQLSRV_FETCH_ASSOC);
        $i = 0;
        $json = array();
        foreach ($query as $fila) {
            $json["data"][$i]["BODEGA"]                 = $fila["BODEGA"];
            $json["data"][$i]["LABORATORIO"]            = $fila["LABORATORIO"];
            $json["data"][$i]["ARTICULO"]               = $fila["ARTICULO"];
            $json["data"][$i]["DESCRIPCION"]            = $fila["DESCRIPCION"];
            $json["data"][$i]["ANNO"]                   = $fila["ANNO"];
            $json["data"][$i]["TOTAL_ART_VENDIDO"]      = number_format($fila["TOTAL_ART_VENDIDO"],2);
            $json["data"][$i]["UNIDAD_VENDIDA_ANUAL"]   = number_format($fila["UNIDAD_VENDIDA_ANUAL"],2);
            $json["data"][$i]["TOTAL_VENTA_ANUAL"]      = number_format($fila["TOTAL_VENTA_ANUAL"],2);
            $json["data"][$i]["PROMEDIO_VENTA_ANUAL"]   = number_format($fila["PROMEDIO_VENTA_ANUAL"],2);
            $i++;
        }
        echo json_encode($json);
        $this->sqlsrv->close();
    }
}