<header class="demo-header mdl-layout__header ">
    <div class="centrado  ColorHeader">
        <span class=" title">Puntos clientes</span>
        <a href="#" style="float: right; margin-right: 1rem; color: white" id="btn_updte_existe" ><i class="material-icons">refresh</i></a>
        <a href="#!" style="float: left; margin-left: 1rem; color: white" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    </div>

</header>

<div class="container" style="width: 100%!important;">
  <div class="card">
    <div class="card-content">
      <div class="row">
        <div class="col s12 m8">
          <div class="input-group" style="margin-top: 0px!important">
            <span class="input-group-addon"><i class="small material-icons">search</i></span>
            <input type="text" id="searchCatalogo" placeholder="Buscar clientes">
          </div>          
        </div>
        <div class="col s12 m4">
          <select class="browser-default" id="frm_lab_row">
              <option value="10">10</option>
              <option value="100">100</option>
              <option value="-1">Todas las filas...</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col s12 m12">
            <p>Ultima actualización: <?php echo date('d/m/Y h:i a', strtotime($Lst_Update[0]['Fecha']))?></p>
            
            <table class="table striped RobotoR" id="tblArticulos">
                <thead>
                    <tr>
                        <th>COD. CLIENTE</th>
                        <th>NOMBRE DEL CLIENTE</th>
                        <th>PUNTOS DISP.</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(!$CLIENTES){
                        }
                        else{
                            foreach($CLIENTES as $key){
                                echo "
                                    <tr>
                                        <td><a href='#' onclick='getTransac(".'"'.$key['mCliente'].'","'.str_replace("'","",$key['mNombre']).'"'.")'>".$key["mCliente"]."</a></td>
                                        <td class='left'>".$key["mNombre"]."</td>
                                        <td>".number_format($key['mPuntos'],0)."</td>
                                        
                                    </tr>
                                ";
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
</div>



 <!-- Modal ARTICULOS Structure -->
    <div id="modalArtic" class="modal">
      <div class="modal-content">
        <a id="id_prn_report" class=" right" ><i class="material-icons blue-text">print</i></a>
        <h4 class="center indigo-text darken-4" id="modalEncabezado"></h4>
        <p class="center indigo-text darken-4" id="h6Articulo">ID CLIENTE: <span id="modalIdArticulo"></span> - PUNTOS: <span id="tTotalPuntos"></span></p>
        <table class="table striped RobotoR" id="tbl_trasn">
          <thead>
            <tr>
              <th>CODIGO</th>
              <th>FECHA</th>
              <th>PUNTOS DISP.</th>
            </tr>
          </thead>
          <tbody class="Centrado">

          </tbody>
        </table>
      </div>
    </div>

