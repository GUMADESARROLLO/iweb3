<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function listarArticulos()
    {
        $query = $this->sqlsrv->fetchArray("SELECT * FROM iweb_articulos",SQLSRV_FETCH_ASSOC);
        if($query){
            return $query;
        }
        $this->sqlsrv->close();
    }

    public function getTransaccines($ID){
        $query = $this->sqlsrv->fetchArray("SELECT TOP 3 * FROM iweb_transacciones WHERE ARTICULO = '$ID' ORDER BY FECHA DESC",SQLSRV_FETCH_ASSOC);
        $i=0;
        $json = array();
        foreach($query as $fila){
            $json["data"][$i]["FECHA"] = date_format($fila["FECHA"],"d/m/Y");
            $json["data"][$i]["LOTE"] = $fila["LOTE"];
            $json["data"][$i]["DESCRTIPO"] = $fila["DESCRTIPO"];
            $json["data"][$i]["CANTIDAD"] = number_format($fila["CANTIDAD"],2);
            $json["data"][$i]["REFERENCIA"] = $fila["REFERENCIA"];
            $i++;
        }
        echo json_encode($json);
        $this->sqlsrv->close();
    }
    public function getTransaccionesDetalles($D1,$D2,$ID){
        $query = $this->sqlsrv->fetchArray("SELECT * FROM iweb_transacciones WHERE ARTICULO = '$ID'  AND FECHA  BETWEEN '$D1' AND '$D2'  ORDER BY ARTICULO ASC",SQLSRV_FETCH_ASSOC);
        $i=0;
        $json = array();
        foreach($query as $fila){
            $json["data"][$i]["FECHA"] = date_format($fila["FECHA"],"d/m/Y");
            $json["data"][$i]["LOTE"] = $fila["LOTE"];
            $json["data"][$i]["DESCRTIPO"] = $fila["DESCRTIPO"];
            $json["data"][$i]["CANTIDAD"] = number_format($fila["CANTIDAD"],2);
            $json["data"][$i]["REFERENCIA"] = $fila["REFERENCIA"];
            $i++;
        }
        echo json_encode($json);
        $this->sqlsrv->close();
    }

    public function getBodegas($ID)
    {
        $query = $this->sqlsrv->fetchArray("SELECT * FROM iweb_bodegas WHERE ARTICULO = '$ID'", SQLSRV_FETCH_ASSOC);
        $i = 0;
        $json = array();
        foreach ($query as $fila) {
            $json["data"][$i]["id"] = $i;
            $json["data"][$i]["DETALLE"] = '<i class="material-icons">details</i>';
            $json["data"][$i]["BODEGA"] = $fila["BODEGA"];
            $json["data"][$i]["NOMBRE"] = $fila["NOMBRE"];
            $json["data"][$i]["CANT_DISPONIBLE"] = number_format($fila["CANT_DISPONIBLE"],2);
            $i++;
        }
        echo json_encode($json);
        $this->sqlsrv->close();
        
    }
    public function getIngresos($ARTICULO,$LOTE)
    {
        $query = $this->sqlsrv->fetchArray("SELECT * FROM iweb_ingreso_lote WHERE ARTICULO = '$ARTICULO' AND LOTE='$LOTE' ORDER BY FECHA_ENTRADA ASC", SQLSRV_FETCH_ASSOC);
        $i = 0;
        $json = array();
        foreach ($query as $fila) {
            $json["data"][$i]["FECHA_ENTRADA"] = date('d/m/Y',strtotime($fila["FECHA_ENTRADA"]));
            $json["data"][$i]["CANTIDAD_INGRESADA"] = number_format($fila["CANTIDAD_INGRESADA"],2);
            $i++;
        }
        echo json_encode($json);
        $this->sqlsrv->close();

    }

    public function getLotes($Bodega,$Art)
    {
        $query = $this->sqlsrv->fetchArray("SELECT * FROM iweb_lotes WHERE BODEGA = '$Bodega' AND ARTICULO = '$Art'", SQLSRV_FETCH_ASSOC);
        $i = 0;
        $json = array();
        foreach ($query as $fila) {
            $json["data"][$i]["ARTICULO"] = $fila["ARTICULO"];
            $json["data"][$i]["BODEGA"] = $fila["BODEGA"];
            $json["data"][$i]["CANT_DISPONIBLE"] = number_format($fila["CANT_DISPONIBLE"], 2);
            $json["data"][$i]["LOTE"] = $fila["LOTE"];
            $json["data"][$i]["FECHA_INGRESO"] = date('d/m/Y',strtotime($fila["FECHA_ENTR"]));
            $json["data"][$i]["CANTIDAD_INGRESADA"] = number_format($fila["CANTIDAD_INGRESADA"], 2);
            $json["data"][$i]["FECHA_ENTRADA"] = date('d/m/Y',strtotime($fila["FECHA_ENTRADA"]));
            $json["data"][$i]["FECHA_VENCIMIENTO"] = date('d/m/Y',strtotime($fila["FECHA_VENCIMIENTO"]));
            $i++;
        }
        echo json_encode($json);
        $this->sqlsrv->close();
    }

    public function getPrecios($ID)
    {
        $query = $this->sqlsrv->fetchArray("EXEC sp_iweb_precios '$ID'", SQLSRV_FETCH_ASSOC);
        $i = 0;
        $json = array();
        foreach ($query as $fila) {
            $json["data"][$i]["NIVEL_PRECIO"] = $fila["NIVEL_PRECIO"];



            $json["data"][$i]["PRECIO"] = ($fila["PRECIO"]=="") ? "N/D" : number_format($fila["PRECIO"],2);

            $i++;
        }

        $json["columns"][0]["data"] = "NIVEL_PRECIO";
        $json["columns"][0]["name"] = "NIVEL PRECIO";
        $json["columns"][1]["data"] = "PRECIO";
        $json["columns"][1]["name"] = "PRECIO";

        echo json_encode($json);
        $this->sqlsrv->close();
    }

    public function getBonificados($ID)
    {
        $query = $this->sqlsrv->fetchArray("SELECT REGLAS FROM GMV_mstr_articulos WHERE ARTICULO = '$ID'", SQLSRV_FETCH_ASSOC);
        $i = 0;
        $json = array();
       
       
        foreach ($query as $fila) {
            $porciones = explode(",", $fila["REGLAS"]);
            for($n=0;$n<count($porciones);$n++){
                $json["data"][$i]["REGLAS"] = $porciones[$n];
                $i++;
            }
           
        }

        $json["columns"][0]["data"] = "REGLAS";
        $json["columns"][0]["name"] = "REGLAS";

        echo json_encode($json);
        $this->sqlsrv->close();
    }

}