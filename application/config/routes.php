<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'login_controller';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/******** MIS RUTAS **********/
// LOGIN
$route['login'] = 'login_controller/Acreditar';
$route['salir'] = 'login_controller/Salir';

// FIN LOGIN

//MAIN 
$route['Main'] = 'Main_controller/index';
$route['Transacciones/(:any)'] = 'Main_controller/getTransacciones/$1';
$route['TransaccionesDetalles/(:any)/(:any)/(:any)/(:any)'] = 'Main_controller/getTransaccionesDetalles/$1/$2/$3/$4';
$route['Ingresos/(:any)/(:any)'] = 'Main_controller/getIngresos/$1/$2';
$route['Bodegas/(:any)'] = 'Main_controller/getBodegas/$1';
$route['Lotes/(:any)/(:any)'] = 'Main_controller/getLotes/$1/$2';
$route['Precios/(:any)'] = 'Main_controller/getPrecios/$1';
$route['Bonificados/(:any)'] = 'Main_controller/getBonificados/$1';
$route['InvBodega'] = 'Invbodega_controller/index';
$route['getInvBodegas/(:any)'] = 'Invbodega_controller/getInvBodegas/$1';

//RESEVA
$route['Reserva'] = 'Reserva_controller/index';

//LIQUIDACION
$route['6Meses'] = 'Liquidacion_controller/seisMeses';
$route['12Meses'] = 'Liquidacion_controller/doceMeses';

//USUARIOS
$route["Usuarios"] = "Usuarios_controller";
$route["GuardaUsuarios"] = "Usuarios_controller/guardarUser";
$route["EliminaUsuarios/(:any)"] = "Usuarios_controller/eliminaUser/$1";
$route["ActualizaUsuarios"] = "Usuarios_controller/actualizarPass";





