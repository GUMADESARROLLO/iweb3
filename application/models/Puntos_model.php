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
        //$query = $this->sqlsrv->fetchArray("SELECT * FROM vtVS2_Clientes",SQLSRV_FETCH_ASSOC);
        $query = $this->db->get('vstPuntos');
        if ($query->num_rows()>0) {
            return $query->result_array();
        }
        //$this->sqlsrv->close();
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
        $json = array();
        $data = array();
        //$this->db->truncate('mpoint');
        $query = $this->sqlsrv->fetchArray("SELECT TOP 200 * FROM iweb_puntos",SQLSRV_FETCH_ASSOC);
        foreach($query as $key){
            //$Remanente = number_format($this->FacturaSaldo($key['FACTURA'],$key['TOTAL']),2,'.','');
            $Remanente = $key['TOTAL'];
           $name = $this->sanear_string ($key['NOMBRE_CLIENTE']);
            $date = DateTime::createFromFormat('d/m/Y', $key["FECHA"]);
            $forSQL = $date->format('Y-m-d');
            if (intval($Remanente) > 0) {
                //$json[$i]=array(date('Y-m-d',strtotime($key["FECHA"])),$key["CLIENTE"],$name,$key["FACTURA"],$key["TOTAL"],$Remanente);
                $data[$i]=
                    array(
                        'mFecha' => date('Y-m-d',strtotime($key["FECHA"])),
                        'mFecha2' => $key["FECHA"],
                        'mFecha3' => $key["FECHA"],
                        'mCliente' => $forSQL,
                        'mNombre' => $name,
                        'mFactura' => $key["FACTURA"],
                        'mPuntos' => number_format($key["TOTAL"],0),
                        'mRemanente' => number_format($Remanente,0)
                    );
                $i++;
            }

        }

        //TODO QUEDA PENDIENTE LA VALIDACION DE LOS PUNTOS CORRESPODIENTES

       // echo  json_encode($data);



       //$this->db->insert_batch('mpoint', $data);
        //$this->insert_rows('mpoint', $json,false);
        //echo $i;
        //echo ($query) ? true : false ;
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

        $this->db->limit(1);
        $this->db->order_by('FechaActualizacion', 'DESC');
        $this->db->where('Factura',$id);
        $this->db->select('Puntos');
        $query = $this->db->get('visys.rfactura');
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

}