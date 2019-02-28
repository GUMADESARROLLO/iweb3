<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogo_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function ajax_Catalogos()
    {

        $id_CatalogoActivo = 0;
        $i = 0;
        $json = array();


        $Query_Get_id_CatalogosActivo = $this->db->query("SELECT * FROM visys.catalogo WHERE Estado='0'");

        if ($Query_Get_id_CatalogosActivo->num_rows()>0) {

            $id_CatalogoActivo = $Query_Get_id_CatalogosActivo->result_array()[0]["IdCT"];

            $Query_Get_Catalogos = $this->db->query("SELECT * FROM visys.detallect WHERE IdCt='".$id_CatalogoActivo."'");




            if ($Query_Get_Catalogos->num_rows()>0) {
                foreach ($Query_Get_Catalogos->result_array() as $fila) {

                    $url_img_catalo = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http")."://".$_SERVER['HTTP_HOST']."/visys2/assets/img/catalogo/".$fila["IMG"];

                    /*if(!$this->url_exists($url_img_catalo)){
                        $url_img_catalo = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http")."://".$_SERVER['HTTP_HOST']."/visys2/assets/img/catalogo/00001.jpg";
                    }*/

                    $json["data"][$i]["Articulo"]            = '<div class="row valign-wrapper" style="border-bottom: 1px solid #ccc!important;">
                                                                    <div class="col s2">
                                                                        <div class="card-panel ">
                                                                        <img src="'.$url_img_catalo.'" alt="" class="circle responsive-img"></div>
                                                                    </div>
                                                                    
                                                                    <div class="col s10">
                                                                        <h5><span class="black-text left">'.$fila["Nombre"].'</span></h5><br>
                                                                        <h6><span class="left">Cod. '.$fila["IdIMG"].'</span></h6>
                                                                        <br><br>
                                                                        <span class="left"><h4>'.number_format($fila["Puntos"],0).' pts.</h4></span>
                                                                    </div>
                                                                </div>';
                    $i++;
                }
            }
        }
        echo json_encode($json);
    }

    function url_exists( $url = NULL ) {

        if( empty( $url ) ){
            return false;
        }

        $ch = curl_init( $url );

        // Establecer un tiempo de espera
        curl_setopt( $ch, CURLOPT_TIMEOUT, 5 );
        curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 5 );

        // Establecer NOBODY en true para hacer una solicitud tipo HEAD
        curl_setopt( $ch, CURLOPT_NOBODY, true );
        // Permitir seguir redireccionamientos
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
        // Recibir la respuesta como string, no output
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

        // Descomentar si tu servidor requiere un user-agent, referrer u otra configuración específica
        // $agent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36';
        // curl_setopt($ch, CURLOPT_USERAGENT, $agent)

        $data = curl_exec( $ch );

        // Obtener el código de respuesta
        $httpcode = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
        //cerrar conexión
        curl_close( $ch );

        // Aceptar solo respuesta 200 (Ok), 301 (redirección permanente) o 302 (redirección temporal)
        $accepted_response = array( 200, 301, 302 );
        if( in_array( $httpcode, $accepted_response ) ) {
            return true;
        } else {
            return false;
        }

    }

}