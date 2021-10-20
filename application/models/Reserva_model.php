<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reserva_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function listarArticulos()
    {
        $Array = $this->sqlsrv -> fetchArray('SELECT * from WEB_GGG_MAX_MIN',SQLSRV_FETCH_ASSOC);
        $json = array();
        $i=0;

        foreach ($Array as $fila)
        {

            $json['data'][$i]['ARTICULO'] = $fila['ARTICULO'];
            $json['data'][$i]['desc'] = $fila['MEDIC_TIPO'];
            $json['data'][$i]['MIN_SALIDA_A'] =number_format( $fila['MIN_SALIDA_A'],2);
            $json['data'][$i]['MAX_SALIDA_A'] =number_format( $fila['MAX_SALIDA_A'],2);
            $json['data'][$i]['PLAZO_REABAST'] = $fila['PLAZO_REABAST'];
            $json['data'][$i]['CANT_RESER'] = number_format($fila['CANT_RESERVADA'],2);
            $json['data'][$i]['EXISTENCIAS'] =intval( $fila['EXISTENCIAS']);
            $json['data'][$i]['TOTAL_A'] = number_format($fila['TOTAL_A'],2);
            $json['data'][$i]['CONSUM_MIN_DIARIO'] = number_format($fila['CONSUM_MIN_DIARIO'],2);
            $json['data'][$i]['CONSUM_MAX_DIARIO'] = number_format($fila['CONSUM_MAX_DIARIO'],2);
            $json['data'][$i]['CANT_PEDIDO'] = number_format($fila['CANT_PEDIDO'],2);
            $json['data'][$i]['EXIST_MIN'] = number_format( $fila['EXIST_MIN'],2);
            $json['data'][$i]['EXIST_MAX'] = number_format($fila['EXIST_MAX'],2);
            $json['data'][$i]['PUNTO_REORDEN'] = number_format($fila['PUNTO_REORDEN'],2);
            $json['data'][$i]['CERCA_MIN'] = number_format($fila['CERCA_MIN'],2);
            $json['data'][$i]['reserva'] = intval($fila['CANT_RESERVA']);
            $json['data'][$i]['adv'] = $fila['ADVERTENCIA'];
            $json['data'][$i]['prom_3_meses'] = $this->traerPromedio($fila['ARTICULO'],3);
            $json['data'][$i]['prom_6_meses'] = $this->traerPromedio($fila['ARTICULO'],6);

            $i++;

        }

        return $json;

        $this->sqlsrv->close();
    }
    public function traerPromedio($articulo,$meses){
        $Array = $this->sqlsrv -> fetchArray("SELECT ARTICULO, Softland.dbo.prom_3Meses(ARTICULO,".$meses.") AS PROMEDIO FROM Softland.umk.ARTICULO where ARTICULO='".$articulo."'",SQLSRV_FETCH_ASSOC);
        if (count($Array)>0) {
            return $Array[0]['PROMEDIO'];
        }
    }
}