<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_model extends CI_Model
{
    public function __construct()
    {
        $this->lang->load('modules','english');
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
    public function get_ajx_item($condicion)
    {

        $strgCondicion= ($condicion==0) ? "" : " WHERE ARTICULO LIKE '1%'" ;

        $query = $this->sqlsrv->fetchArray("SELECT * FROM iweb_articulos".$strgCondicion,SQLSRV_FETCH_ASSOC);

        $i=0;
        $json = array();
        foreach($query as $fila){
            $rvPuntos = ($fila["PUNTOS"]=="") ? "N/D" : $fila["PUNTOS"] ;
            $json["data"][$i]["CODIGO"] = "<a href='#' onclick='getTransac(".'"'.$fila["ARTICULO"].'","'.str_replace("'","",$fila['DESCRIPCION']).'"'.")'>".$fila["ARTICULO"]."</a>" ;
            $json["data"][$i]["DESCRI"] = $fila["DESCRIPCION"];
            $json["data"][$i]["PRECIO"] = number_format($fila["PRECIO_FARMACIA"],2);
            $json["data"][$i]["BDG002"] = number_format($fila["total"],2);
            $json["data"][$i]["BDG006"] = number_format($fila["006"],2);
            $json["data"][$i]["PUNTOS"] = $rvPuntos;
            $i++;
        }
        echo json_encode($json);
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
    public function getTransaccionesDetalles($D1,$D2,$ID,$TP){
        $query = $this->sqlsrv->fetchArray("SELECT * FROM iweb_transacciones WHERE ARTICULO = '$ID' AND DESCRTIPO = '$TP' AND FECHA  BETWEEN '$D1' AND '$D2'  ORDER BY ARTICULO ASC",SQLSRV_FETCH_ASSOC);
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

            $id = "dv-".$fila["BODEGA"];
            $ld = "i-".$fila["BODEGA"];

            $json["data"][$i]["id"] = $i;
            $json["data"][$i]["DETALLE"] = '
                        <i id="'.$ld.'" class="material-icons">details</i>
                        <div id="'.$id.'"  style="display: none" class="preloader-wrapper small active" >
                            <div class="spinner-layer spinner-yellow-only">
                                <div style="overflow: visible!important;" class="circle-clipper left">
                                    <div class="circle"></div>
                                </div>
                                <div class="gap-patch">
                                    <div class="circle"></div>
                                </div>
                                <div style="overflow: visible!important;" class="circle-clipper right">
                                    <div class="circle"></div>
                                </div>
                            </div>
                        </div>';
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

    public function lst_ajax_Modulos($Id) {

        $temp = array();
        $i=0;
        $data = $this->db->get("modules");
        if ($data->num_rows()>0) {
            foreach ($data->result_array() as $key) {

                $Permisos = $Id.",'".$key['Modulo_name_id']."'";


                $data = array(
                    'name'          => $key['Modulo_name_id'],
                    'id'            => $key['Modulo_name_id'],
                    'value'         => $key['Modulo_name_id'],
                    'checked'       => $this->has_permission
                    (
                        $key['Modulo_name_id'],
                        $Id
                    ),
                    'style'         => 'margin:10px',
                    'onClick'       => 'getPermiso('.$Permisos.')'
                );



                $temp["data"][$i]["Id"]     = $key['Modulo_id'];
                $temp["data"][$i]["name"]   = $key['Modulo_full_name'];

                $temp["data"][$i]["chck"]   = form_checkbox($data);
                $i++;
            }

        }

        echo json_encode($temp);
    }
    function has_permission($module_id,$person_id)
    {
        if($module_id==null)
        {
            return true;
        }

        $query = $this->db->get_where('permissions',
            array(
                'Usuario_id' => $person_id,
                'modules_id'=>$module_id
            ), 1);
        return $query->num_rows() == 1;


    }
    public function lst_ajax_SavePermisos($Usuario,$Modulo) {

        if ($this->has_permission($Modulo,$Usuario)==false){
            $this->db->insert('permissions', array (
                'Usuario_id' => $Usuario,
                'modules_id' => $Modulo,
                'FechaCreacion' => date("Y-m-d"),
                'usuarioCU' => $this->session->userdata('id')

            ));
            echo json_encode(($this->db->affected_rows() > 0) ? 1 : 0);
        }else{
            $this->db->delete('permissions',
                array(
                    'Usuario_id' => $Usuario,
                    'modules_id' => $Modulo
                ), 1);
            echo json_encode(($this->db->affected_rows() > 0) ? 1 : 0);
        }


    }

    public function get_permission() {
        $Id  = $this->session->userdata('id');
        $data = $this->db->query("SELECT * FROM view_permissions WHERE Usuario_id = '$Id'", SQLSRV_FETCH_ASSOC);
        if ($data->num_rows()>0) {
            return $data->result_array();
        }
        return 0;

    }

}