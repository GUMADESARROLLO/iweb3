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
        $i = 0; $c = 1;
        $json = array();


        $Query_Get_id_CatalogosActivo = $this->db->query("SELECT * FROM visys.catalogo WHERE Estado='0'");

        if ($Query_Get_id_CatalogosActivo->num_rows()>0) {

            $id_CatalogoActivo = $Query_Get_id_CatalogosActivo->result_array()[0]["IdCT"];

            $Query_Get_Catalogos = $this->db->query("SELECT * FROM visys.detallect WHERE IdCt='".$id_CatalogoActivo."'");


            $tempo = $Query_Get_Catalogos->result_array();

            if ($Query_Get_Catalogos->num_rows()>0) {
                foreach ($Query_Get_Catalogos->result_array() as $fila) {

                    $url_img_catalo = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http")."://".$_SERVER['HTTP_HOST']."/visys2/assets/img/catalogo/".$fila["IMG"];

                    /*if(!$this->url_exists($url_img_catalo)){
                        $url_img_catalo = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http")."://".$_SERVER['HTTP_HOST']."/visys2/assets/img/catalogo/00001.jpg";
                    }*/

                    if ( $c<=3 ) {
                        if ($fila===end( $tempo )) {
                            switch ($c) {
                                case 1:
                                    $json['data'][$i]['Articulo2'] = "";
                                    $json['data'][$i]['Articulo3'] = "";
                                    break;
                                case 2:
                                    $json['data'][$i]['Articulo3'] = "";
                                    break;

                                case 3:

                                    break;
                            }
                        }                        
                    }elseif ( $c==4 ) {
                        $i++;
                        $c=1;
                    }

                    $NM = 'Articulo'.$c;
                    $json['data'][$i][$NM] = '<div class="row" style="border-bottom: 1px solid #ccc!important; height:200px; width:350px!important">
                                                <div class="col s7" style="height:100%!important;">
                                                    <img src="'.$url_img_catalo.'" style="width:100%!important; height:97%">
                                                </div>                                                
                                                <div class="col s5">
                                                    <p><span class="left" style="color:#1976d2; font-weight: bold">'.$fila["Nombre"].'</span></p><br>
                                                    <h6><span class="left">Cod. '.$fila["IdIMG"].'</span></h6>
                                                    <br><br>
                                                    <span class="left" style="color:#ff5722; font-weight: bold">'.number_format($fila["Puntos"],0).' pts.</span>
                                                </div>
                                            </div>';
                    $c++;
                    
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