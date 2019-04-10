<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cliente_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function detalleCliente( $ID_CLIENTE ) {
    	$dta = array(); $i=0;
        $query = $this->sqlsrv->fetchArray("SELECT * FROM SAC_DISP_CREDITO_UMK WHERE CLIENTE='".$ID_CLIENTE."' ", SQLSRV_FETCH_ASSOC);

        if (count($query)>0) {
        	foreach ($query as $key) {
        		$dta[$i]['CLIENTE'] = $key['CLIENTE'];
        		$dta[$i]['NOMBRE'] = $key['NOMBRE'];
        		$dta[$i]['SALDO'] = $key['SALDO'];
        		$dta[$i]['CREDITODISP'] = $key['CREDITODISP'];
        		$dta[$i]['DIRECCION'] = $key['DIRECCION'];
        		$dta[$i]['T_PUNTOS'] = $this->retornaTotalPuntosxCliente( $key['CLIENTE'] );
        		$i++;
        	}
        	return $dta;
        }

        return false;
        $this->sqlsrv->close();
    }

    public function retornaTotalPuntosxCliente( $ID_CLIENTE ) {

		$query=$this->db->query(" SELECT SUM(mPuntos) AS T_PTS FROM vstpuntos WHERE mCliente='".$ID_CLIENTE."' ");

		if ($query->num_rows()>0) {
			return number_format($query->result_array()[0]['T_PTS']);
		}

		return false;

    }

    public function retornaData($TIPO, $ID_CLIENTE) {
        $dta = array(); $i=0;
    	switch ($TIPO) {
    		case '1':
    			$query = $this->sqlsrv->fetchArray(" SELECT * FROM CxCUMK WHERE CLIENTE='".$ID_CLIENTE."' AND ESTADO_FACTURA='PENDIENTE' AND TIPO='FAC' ORDER BY FECHA_DOCUMENTO DESC ", SQLSRV_FETCH_ASSOC);
    			if (count($query)>0) {

                    foreach ($query as $key) {
                        $dta[$i]['CLIENTE'] = $key['CLIENTE'];
                        $dta[$i]['DOCUMENTO'] = $key['DOCUMENTO'];
                        $dta[$i]['VENDEDOR'] = $key['VENDEDOR'];
                        $dta[$i]['FECHA_DOCUMENTO'] = date('d/m/Y', strtotime($key['FECHA_DOCUMENTO']->format("Y-m-d")));
                        $dta[$i]['MONTO_DOCUMENTO'] = $key['MONTO_DOCUMENTO'];
                        $i++;
                    }

    				echo json_encode($dta);
    			}else {
    				echo json_encode(false);
    			}
                $this->sqlsrv->close();
    			break;

    		case '2':
                $visysDB = $this->load->database('visys', TRUE);
                $query=$visysDB->query(" SELECT * FROM frp WHERE IdCliente='".$ID_CLIENTE."' ORDER BY Fecha DESC ");

                if ($query->num_rows()>0) {
                    foreach ($query->result_array() as $key) {
                        $T_PTS = $visysDB->query(" SELECT SUM(Puntos) AS T_PTS FROM detallefrp WHERE IdFRP='".$key['IdFRP']."'; ");
                        
                        $dta[$i]['ID_FRP'] = $key['IdFRP'];
                        $dta[$i]['FECHA'] = date('d/m/Y', strtotime($key['Fecha']));
                        $dta[$i]['PUNTOS'] = $T_PTS->result_array()[0]['T_PTS'];
                        $i++;
                    }

                    echo json_encode($dta);
                }

                
    			break;
    		
    		default:
    			echo "Ups... parece que ocurrio un problema";
    			break;
    	}
    }

    public function retornaDetalleFactura( $ID_DOC ) {
        $dta=array(); $i = $t_fact = 0;
        $query = $this->sqlsrv->fetchArray(" SELECT * FROM iweb_detalle_factura WHERE FACTURA='".$ID_DOC."' ", SQLSRV_FETCH_ASSOC);
        if (count($query)>0) {

            foreach ($query as $key) {
                $dta[$i]['FACTURA'] = $key['FACTURA'];
                $dta[$i]['FECHA_FACTURA'] = date('d/m/Y', strtotime($key['FECHA_FACTURA']->format("Y-m-d")));
                $dta[$i]['ARTICULO'] = $key['ARTICULO'];
                $dta[$i]['NOMBRE_ARTICULO'] = $key['NOMBRE_ARTICULO'];
                $dta[$i]['CANTIDAD'] = $key['CANTIDAD'];
                $dta[$i]['PRECIO_UNITARIO'] = $key['PRECIO_UNITARIO'];
                $dta[$i]['PRECIO_TOTAL'] = $key['PRECIO_TOTAL'];
                $i++;
            }

            echo json_encode($dta);
        }else {
            echo json_encode(false);
        }
    } 

    public function retornaDetalleCanje( $ID_CANJ ) {
        $dta=array(); $i = 0;
        
        $visysDB = $this->load->database('visys', TRUE);
        $query=$visysDB->query(" SELECT
                                IdFRP,
                                Factura,
                                Fecha,
                                Faplicado,
                                IdArticulo,
                                Descripcion,
                                Cantidad,
                                SUM(Puntos) AS Puntos,
                                Cantidad
                            FROM
                                detallefrp
                            WHERE
                                IdFRP = '".$ID_CANJ."' GROUP BY Factura ");
        
        if ($query->num_rows()>0) {

            foreach ($query->result_array() as $key) {
                $dta[$i]['IdFRP'] = $key['IdFRP'];
                $dta[$i]['Fecha'] = date('d/m/Y', strtotime($key['Fecha']));
                $dta[$i]['Factura'] = $key['Factura'];
                $dta[$i]['Puntos_1'] = $key['Faplicado'];
                $dta[$i]['Puntos'] = $key['Puntos'];
                $dta[$i]['IdArticulo'] = $key['IdArticulo'];
                $dta[$i]['Descripcion'] = $key['Descripcion'];
                $dta[$i]['Cantidad'] = $key['Cantidad'];
                $i++;
            }

            echo json_encode($dta);
        }else {
            echo json_encode(false);
        }
    }
}