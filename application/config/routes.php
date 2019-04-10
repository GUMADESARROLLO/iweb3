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
$route['Main2'] = 'Main_controller/main2';
$route['Home'] = 'Main_controller/main_clean';
$route['ajx_rutas/(:any)'] = 'Main_controller/get_ajx_item/$1';
$route['Transacciones/(:any)'] = 'Main_controller/getTransacciones/$1';
$route['TransaccionesDetalles/(:any)/(:any)/(:any)/(:any)'] = 'Main_controller/getTransaccionesDetalles/$1/$2/$3/$4';
$route['Ingresos/(:any)/(:any)'] = 'Main_controller/getIngresos/$1/$2';
$route['Bodegas/(:any)'] = 'Main_controller/getBodegas/$1';
$route['Lotes/(:any)/(:any)'] = 'Main_controller/getLotes/$1/$2';
$route['Precios/(:any)'] = 'Main_controller/getPrecios/$1';
$route['Bonificados/(:any)'] = 'Main_controller/getBonificados/$1';
$route['InvBodega'] = 'Invbodega_controller/index';
$route['getInvBodegas/(:any)'] = 'Invbodega_controller/getInvBodegas/$1';

$route['StatHome'] = 'Main_controller/Stat_Home';
$route['StatVendedor/(:any)'] = 'Main_controller/Stat_Vendedor/$1';

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


//PUNTOS
$route['PUNTOS'] = 'Puntos_controller/index';
$route['ALLPOINT'] = 'Puntos_controller/getAllPoint';
$route['ajax_getTransac/(:any)'] = 'Puntos_controller/get_facturas_puntos/$1';

$route['ajax_Mod']	= 'Main_controller/lst_ajax_Modulos';
$route['ajax_Mod/(:any)']	= 'Main_controller/lst_ajax_Modulos/$1';
$route['ajax_SavePermisos']	        = 'Main_controller/lst_ajax_SavePermisos';

$route["Stat"] = "stat_controller";
$route["ajax_Stat"] = "stat_controller/getStat";

$route['only002'] = 'Main_controller/only002';
$route['ajax_only002'] = 'Main_controller/ajax_only002';

$route['Catalogos'] = 'Main_controller/Catalogos';
$route['ajax_Catalogos'] = 'Main_controller/ajax_Catalogos';

$route['Disp_Clientes'] = 'Main_controller/Disp_Clientes';
$route['ajax_Disp_Clientes'] = 'Main_controller/ajax_Disp_Clientes';
$route['clientes/(:any)'] = 'clientes_controller/index/$1';
$route['tabs/(:any)/(:any)'] = 'clientes_controller/changeTabs/$1/$2';
$route['dtllFac/(:any)'] = 'clientes_controller/detalleFactura/$1';
$route['dtllCanj/(:any)'] = 'clientes_controller/detalleCanje/$1';

$route['prnt_report_punto_cliente/(:any)']	= 'Puntos_controller/prnt_report_punto_cliente/$1';