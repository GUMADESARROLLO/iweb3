<header class="demo-header mdl-layout__header ">
    <div class="centrado  ColorHeader">
        <span class=" title">Detalle cliente</span>
        <a href="#!" style="float: left; margin-left: 1rem; color: white" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    </div>
</header>

<div class="back-page-cliente">
<a class="btn-floating btn-small waves-effect waves-light green" id="rtClientes" style="position: fixed!important"><i class="material-icons">arrow_back</i></a>
<?php 
if ($dt_c) {
  echo '
  <input type="hidden" id="CLIENTE" readonly value="'.$dt_c[0]['CLIENTE'].'" />
  <div class="container" style="width: 90%!important">
    <div class="row">
      <div class="col s1 center-align">
        <img class="circle responsive-img" src="'.base_url().'assets/img/cliente.png" style="margin-top: 30%">        
      </div>
      <div class="col s7">
        <h5 style="margin-left: 5%">'.$dt_c[0]['CLIENTE'].' - '.$dt_c[0]['NOMBRE'].'</h5>
        <p class="block-dir">'.$dt_c[0]['DIRECCION'].'</p>
      </div>
      <div class="col s4 border-left-1">
        <div class="card right-align cont-info-client">
          <div class="card-content">
            <div class="row">
              <div class="col s12 center-align">
                <span class="font-punts">'.$dt_c[0]['T_PUNTOS'].'</span><br>
                <span class="text-teal">Puntos</span>
              </div>
            </div>
            <div class="row">
              <div class="col s6 center-align">
                <span class="font-other">C$ '.number_format($dt_c[0]['SALDO'], 2).'</span><br>
                <span class="text-teal">Saldo</span>
              </div>
              <div class="col s6 center-align">
                <span class="font-other">C$ '.number_format($dt_c[0]['CREDITODISP'], 2).'</span>
                <span class="text-teal">Disponible</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>';
}
?>
</div>

<div class="container" style="width: 90%!important">
  <div class="row">
    <div class="col s12">
      <div class="row">
        <div class="col s3">
          <ul id="tabs-swipe-demo" class="tabs">
            <li class="tab col s3"><a onclick="changeTabs('1')" class="active" href="#test-swipe-1">Facturas</a></li>
            <li class="tab col s3"><a onclick="changeTabs('2')" href="#test-swipe-2">Puntos</a></li>
          </ul>
        </div>
      </div>
        <!-- BLOQUE DE FACTURAS -->
        <div id="test-swipe-1" class="col s12">
          <div class="row">
            <div class="col s8">
              <p class="font-other">Facturas pendientes</p>
              <table id="tblClientes" class="display" style="width:100%">
                  <thead>
                      <tr style="display: none">
                          <th></th>
                      </tr>
                  </thead>
                  <tbody id="tbody1">
                  </tbody>
              </table>
            </div>
            <div class="col s4 center-align">
              
            </div>
          </div>
        </div>

        <!-- BLOQUE DE PUNTOS -->
        <div id="test-swipe-2" class="col s12">
          <div class="row">
            <div class="col s8">
              <p class="font-other">Canjes realizados</p>
              <table id="tblPuntos" class="display" style="width:100%">
                <thead>
                    <tr style="display: none">
                        <th></th>
                    </tr>
                </thead>
                <tbody id="tbCanjes">
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
  <!-- MODAL FACTURAS -->
  <div id="modalFact" class="modal">
    <div class="modal-content">
      <div class="row">
          <div class="col s12 m6 left-align">
            <h4 id="num_fac"></h4>
            <p id="f_fact"></p>
          </div>
          <div class="col s12 m6 right-align">
              <a href="#" class="modal-action modal-close"><i class="material-icons cancel">clear</i></a>
          </div>
      </div>
      <div class="row">
        <div class="col s12 m12">
          <table id="example" class="display" style="width:100%">
              <thead>
                  <tr>
                      <th width="10%">Articulo</th>
                      <th>Descripcion</th>
                      <th width="10%">Cantidad</th>
                      <th width="10%">Prec unit</th>
                      <th width="10%">Total</th>
                  </tr>
              </thead>
              <tbody id="tbDetFact">
              </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

    <!-- MODAL CANJES -->
  <div id="modalCanjes" class="modal">
    <div class="modal-content">
      <div class="row">
          <div class="col s12 m6 left-align">
            <h4 id="num_canj"></h4>
            <p id="f_canj"></p>
          </div>
          <div class="col s12 m6 right-align">
              <a href="#" class="modal-action modal-close"><i class="material-icons cancel">clear</i></a>
          </div>
      </div>
      <div class="row">
        <div class="col s12 m12" id="container-detll-canj">


        </div>
      </div>
    </div>
  </div>