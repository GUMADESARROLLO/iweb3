<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Puntos_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function listarArticulos()
    {
       
        /*$query = $this->db->get('vstPuntos');
        if ($query->num_rows()>0) {
            return $query->result_array();
        }*/
        
       /* $array = array(
            0 => Array
        (
            'uid' => '100',
            'name' => 'Sandra Shush',
            'url' => 'urlof100'
        ), 
        1 => Array
        (
            'uid' => '5465',
            'name' => 'Stefanie Mcmohn',
            'pic_square' => 'urlof100'
        ), 
        2 => Array
        (
            'uid' => '40489',
            'name' => 'Michael',
            'pic_square' => 'urlof40489'
        ));

        
   
       $QSearch = $this->sqlsrv->fetchArray("SELECT * FROM iweb_puntos WHERE FACTURA='00066254'",SQLSRV_FETCH_ASSOC);
        $this->sqlsrv->close();
        $json = array();
        $i=0;
        $query = $this->db->get('visys.rfactura');
        foreach($query->result_array() as $fila){
            $key = array_search($fila["Factura"], array_column($QSearch, 'FACTURA'));            
            $json["data"][$i]["Factura"] = $fila["Factura"];
            //$json["data"][$i]["LOTE"] = number_format($query[$key]['TT_PUNTOS'],0) - number_format($fila["Puntos"],0);
            $i++;
        }*/

      //  echo json_encode($json);

          //$query = $this->db->get('vstpuntos');
        $query = $this->db->query("SELECT * FROM vstpuntos ");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }        
    }
    public function Last_Update(){
        $query = $this->db->query("SELECT * FROM udt_puntos ORDER BY id DESC LIMIT 1");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
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
    public function getAllPoint()
    {
        $i=0;
        $data = array();
        $this->db->truncate('mpoint');
        $query = $this->sqlsrv->fetchArray("SELECT * FROM iweb_puntos ",SQLSRV_FETCH_ASSOC);
        foreach($query as $key){
            $Remanente = $this->FacturaSaldo($key['FACTURA'],$key['TOTAL']);
           $name = $this->sanear_string ($key['NOMBRE_CLIENTE']);

            if (intval($Remanente) > 0) {
                $data[$i]=
                    array(
                        'mFecha' =>$key["FECHA"]->format('Y-m-d'),
                        'mCliente' => $key["CLIENTE"],
                        //'mFecha' => $forSQL,
                        'mNombre' => $name,
                        'mFactura' => $key["FACTURA"],
                        'mPuntos' => $key["TOTAL"],
                        'mRemanente' => $Remanente
                    );
                $i++;
            }

        }

       // echo  json_encode($data);



       $this->db->insert_batch('mpoint', $data);
        //$this->insert_rows('mpoint', $json,false);
        //echo $i;
        //echo ($query) ? true : false ;
        $this->db->insert('udt_puntos', array(
            'Fecha' =>date('Y-m-d h:i:s'),
            'Usuario' => $this->session->userdata('id')
        ));
        $this->sqlsrv->close();
    }
    function sanear_string($string)
    {

        $string = trim($string);

        $string = str_replace(
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
            $string
        );

        $string = str_replace(
            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
            $string
        );

        $string = str_replace(
            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
            $string
        );

        $string = str_replace(
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
            $string
        );

        $string = str_replace(
            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
            array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
            $string
        );

        $string = str_replace(
            array('ñ', 'Ñ', 'ç', 'Ç'),
            array('n', 'N', 'c', 'C',),
            $string
        );

        //Esta parte se encarga de eliminar cualquier caracter extraño
        $string = str_replace(
            array(
             "·", "$", "%", "&", "/",
             "(", ")", "?", "'", "¡",
             "¿", "[", "^", "<code>", "]",
             "+", "}", "{", "¨", "´",
             ">", "< ", ";", ",", ":",
             "."),
        '',
        $string
    );


    return $string;
}

    public function FacturaSaldo($id,$pts){

        $query = $this->db->query("SELECT * FROM visys.rfactura WHERE Factura='".$id."' ORDER BY FechaActualizacion DESC");

        if($query->num_rows() > 0){
            $parcial = $query->result_array()[0]['Puntos'];
        } else {
            $parcial = $pts;
        }
        return $parcial;
    }




    function insert_rows($table_name, $rows, $escape = true)
    {
        if( $escape ) array_walk_recursive( $rows, array( $this, 'escape_value' ) );
        for($i = 0; $i < count($rows); $i++) $rows[$i] =  "'".implode("','",$rows[$i])."'";
        $values = "(" . implode( '),(', $rows ) . ")";
        $sql = "INSERT INTO $table_name VALUES $values";
        echo $sql;
        return $this->db->simple_query($sql);
    }
    function escape_value(& $value)
    {

        if( is_string($value) )
        {
            $value = "'" .mysql_real_escape_string($value) . "'";
        }
    }

    function get_facturas_puntos($Cliente){
        $i = 0;
        $json = array();
        $query = $this->db->query("SELECT * FROM mpoint WHERE mCliente='".$Cliente."'");
        foreach ( $query->result_array()as $item) {
            $json["data"][$i]["mFactura"]     = $item['mFactura'];
            $json["data"][$i]["mFecha"]       = date('d/m/Y',strtotime($item['mFecha']));
            $json["data"][$i]["mRemanente"]   = number_format($item['mRemanente'],0);
            $i++;
        }
        echo json_encode($json);

    }

}