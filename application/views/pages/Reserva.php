<header class="demo-header mdl-layout__header ">
    <div class="centrado  ColorHeader"><span class=" title">UNIMARK S.A</span></div>
</header>

<main class="mdl-layout__content mdl-color--grey-100">
    <div class="mdl-grid demo-content">
        <div class="row">
            <div class="col s12 m12">
                <div class="card hoverable horizontal">
                    <div class="row" style="margin-top: 20px">
                        <div class="col s9 m7">
                            <i class="material-icons prefix">search</i>
                            <input type="text" id="searchCatalogo" class="validate mayuscula">
                        </div>
                        <div class="col s1 m2" style="margin-top: 10px">
                            <select class="browser-default" id="frm_lab_menu">
                                <option value="">ESTADOS...</option>
                            </select>
                        </div>
                        <div class="col s1 m2" style="margin-top: 10px">
                            <select class="browser-default" id="frm_lab_row">
                                <option value="10">10</option>
                                <option value="100">100</option>
                                <option value="-1">Todas las filas...</option>
                            </select>
                        </div>
                        <div class="col s1 m1 center" style="margin-top: 10px">
                            <a class="modal-trigger"  href="#ModalDetalles"><i class="material-icons">info</i></a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    <div class="mdl-grid demo-content">
        <div class="row" style="width:100%">

            <div class="left" id="lstEstados"></div>

        <div class="row center">
            <table class="table striped" id="tblArticulos">
                <thead>
                    <tr>
                        <th> ARTICULO</th>
                        <th> DESCRIPCIÓN</th>
                        <th> CANTIDAD DISPONIBLE</th>
                        <th> CANTIDAD EN RESERVA</th>
                        <th> RESERVAR S/N</th>
                        <th> TOTAL A RESERVAR</th>
                        <th> TOTAL AÑO</th>
                        <th> PROM MENSUAL 3</th>
                        <th> PROM MENSUAL 6</th>
                        <th> CONSUMO MINIMO DIARIO</th>
                        <th> CONSUMO MAXIMO DIARIO</th>
                        <th> CANTIDAD A PEDIR</th>
                        <th> EXISTENCIAS MINIMAS</th>
                        <th> EXISTENCIAS MAXIMAS</th>
                        <th> PUNTO DE REORDEN</th>
                        <th style="display: none"></th>
                    </tr>
                </thead>

                <tfoot style="display: none">
                <tr>
                    <th> ARTICULO</th>
                    <th> DESCRIPCIÓN</th>
                    <th> CANTIDAD DISPONIBLE</th>
                    <th> CANTIDAD EN RESERVA</th>
                    <th> RESERVAR S/N</th>
                    <th> TOTAL A RESERVAR</th>
                    <th> TOTAL AÑO</th>
                    <th> PROM MENSUAL 3</th>
                    <th> PROM MENSUAL 6</th>
                    <th> CONSUMO MINIMO DIARIO</th>
                    <th> CONSUMO MAXIMO DIARIO</th>
                    <th> CANTIDAD A PEDIR</th>
                    <th> EXISTENCIAS MINIMAS</th>
                    <th> EXISTENCIAS MAXIMAS</th>
                    <th> PUNTO DE REORDEN</th>
                    <th></th>
                </tr>
                </tfoot>

                <tbody>
                    <?php
                        if(!$Articulos){
                        }
                        else{
                            foreach($Articulos["data"] as $key){


                                $SN = ($key['EXISTENCIAS']<=$key['CERCA_MIN']) ? "S" : "N" ;
                                $COLOR = ($key['EXISTENCIAS']<=$key['CERCA_MIN']) ? "#FF9595" : "#05539E" ;
                                echo "
                                    <tr style='background-color: ".$COLOR."'>
                                        <td>".$key["ARTICULO"]."</td>
                                        <td style='text-align: center'>".$key['desc']."</td>
                                             <td style='text-align: center'>".$key['EXISTENCIAS']."</td>
                                             <td style='text-align: center'>".$key['CANT_RESER']."</td>
                                             <td style='text-align: center'>".$SN."</td>
                                             <td style='text-align: center'>".$key['reserva']."</td>
                                             <td style='text-align: center'>".$key['TOTAL_A']."</td>
                                             <td style='text-align: center'>".number_format($key['prom_3_meses'],0)."</td>
                                             <td style='text-align: center'>".number_format($key['prom_6_meses'],0)."</td>
                                             <td style='text-align: center'>".$key['CONSUM_MIN_DIARIO']."</td>
                                             <td style='text-align: center'>".$key['CONSUM_MAX_DIARIO']."</td>
                                             <td style='text-align: center'>".$key['CANT_PEDIDO']."</td>
                                             <td style='text-align: center'>".$key['EXIST_MIN']."</td>
                                             <td style='text-align: center'>".$key['EXIST_MAX']."</td>
                                             <td style='text-align: center'>".$key['PUNTO_REORDEN']."</td>
                                             
                                             <td style='display: none'>".((($key['EXISTENCIAS']!=0)) ? 'Sin Reserva' : "En Reserva")."</td>
                                    </tr>";


                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
  </div>
</div>
</main>
<div id="ModalDetalles" class="modal">
<div class="modal-content">
    <table id="tblAlvaro" style="font-size:11px;">
        <thead>
        <tr style="background-color:#253778; color:white;">
            <th style="text-align: center"> ARTICULO</th>
            <th style="text-align: center"> DESCRIPCIÓN</th>
            <th style="text-align: center"> CANTIDAD DISPONIBLE</th>
            <th style="text-align: center"> CANTIDAD EN RESERVA</th>
            <th style="text-align: center"> RESERVAR S/N</th>
            <th style="text-align: center"> TOTAL A RESERVAR</th>
            <th style="text-align: center"> TOTAL AÑO</th>
            <th style="text-align: center"> CONSUMO MINIMO DIARIO</th>
            <th style="text-align: center"> CONSUMO MAXIMO DIARIO</th>
            <th style="text-align: center"> CANTIDAD A PEDIR</th>
            <th style="text-align: center"> EXISTENCIAS MINIMAS</th>
            <th style="text-align: center"> EXISTENCIAS MAXIMAS</th>
            <th style="text-align: center"> PUNTO DE REORDEN</th>
        </tr>
        </thead>
        <tbody>
        <tr style="text-transform: uppercase; font-weight:bold;">
            <td>CODIGO DEL ARTICULO</td>
            <td>DESCRIPCION DEL ARTICULO</td>
            <td>Existencia en Bodegas</td>
            <td>lo que ese encuentra en reserva actualmente</td>
            <td>si esta disponible para reserva</td>
            <td>lo que se debe reservar</td>
            <td></td>
            <td>margen llamado de seguridad</td>
            <td>garantiza que siempre hayan existencia de pedidos</td>
            <td>cantidad que se debe de pedidr para mantener en existencia</td>
            <td>Em=Cm*Tr, Consumo Minimo por el tiempo de reposicion</td>
            <td>EM=CM*Tr+Em, Existencia Maxima= Consumo Minimo * Tiempor de reposicion +Existencia Minimas</td>

        </tr>
        </tbody>
    </table>
</div>
<div class="modal-footer">
    <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
</div>
</div>
 <!-- Modal ARTICULOS Structure -->
  <div id="modalArtic" class="modal">
    <div class="modal-content">
    <a class=" right modal-action modal-close"><i class="material-icons blue-text">close</i></a>
      <h4 class="center indigo-text darken-4" id="modalEncabezado"></h4>
      <h5 class="center indigo-text darken-4" id="h6Articulo">CODIGO: <span id="modalIdArticulo"></span></h5>
          <div class="row">
    <div class="col s12">
      <ul class="tabs">
        <li class="tab col s3"><a class="active" href="#trans">Transacciones</a></li>
        <li class="tab col s3"><a href="#bodega">Bodega</a></li>
        <li class="tab col s3"><a href="#lote">Lotes</a></li>
        <li class="tab col s3"><a href="#precio">Precios</a></li>
         <li class="tab col s3"><a href="#bonificado">Bonificados</a></li>
      </ul>
    </div>
<br>
    <div id="trans" class="col s12">
<div class="center">
    <div class="preloader-wrapper big active" id="load">
        <div class="spinner-layer spinner-blue-only">
            <div class="circle-clipper left">
                <div class="circle"></div>
            </div>
            <div class="gap-patch">
                <div class="circle"></div>
            </div>
            <div class="circle-clipper right">
                <div class="circle"></div>
            </div>
        </div>
    </div>
</div>

<div class="right" id="dropTipo"></div>
       <div id="trasn">
        </div>
    </div>


    <div id="bodega" class="col s12">
          <div id="Bodega">
          </div>              
    </div>



    <div id="lote" class="col s12">
        <div id="Lote">
        </div>
    </div>

    <div id="precio" class="col s12">
       <div id="Precio">
       </div>
    </div>

    <div id="bonificado" class="col s12">
         <div id="bonificados">
        </div>               
    </div>
  </div>
    </div>
    <!-- <div class="modal-footer">
    </div> -->
  </div>