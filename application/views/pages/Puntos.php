<header class="demo-header mdl-layout__header ">
    <nav>
        <div class="nav-wrapper" >
            <span class=" title">UNIMARK S.A - SUPLIENDO SALUD</span>
            <ul class="right hide-on-med-and-down">
                <li><a href="#" id="btn_updte_existe" ><i class="material-icons">refresh</i></a></li>
            </ul>
        </div>
    </nav>

</header>


<main class="mdl-layout__content mdl-color--grey-100">
    <div class="mdl-grid demo-content">
        <div class="row">
            <div class="col s12 m12">
                <div class="card hoverable horizontal">
                    <div class="row" style="margin-top: 20px">
                        <div class="col s10 m10">
                            <i class="material-icons prefix">search</i>
                            <input type="text" id="searchCatalogo">
                        </div>

                        <div class="col s1 m2" style="margin-top: 10px">
                            <select class="browser-default" id="frm_lab_row">
                                <option value="10">10</option>
                                <option value="100">100</option>
                                <option value="-1">Todas las filas...</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div> Ultima actualización: <?php echo $Lst_Update[0]['Fecha']; ?></div>
            </div>
        </div>

        <div class="row" style="width:100%">

            <div STYLE="margin-right: 10px;" class="right m12" id="lstProveedores"></div>
        <div class="row center">

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

                               // $rvPuntos = ($key["PUNTOS"]=="") ? "N/D" : $key["PUNTOS"] ;
                               // $rvLab = ($key["LABORATORIO"]=="") ? "N/D" : $key["LABORATORIO"] ;

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
</main>

 <!-- Modal ARTICULOS Structure -->
      <div id="modalArtic" class="modal">
          <div class="modal-content">
              <a class=" right modal-action modal-close"><i class="material-icons blue-text">close</i></a>
              <h4 class="center indigo-text darken-4" id="modalEncabezado"></h4>
              <div class="row" >
                  <div class="col s6 ">
                      <h5 class="center indigo-text darken-4" id="h6Articulo">CLIENTE: <span id="modalIdArticulo"></span></h5>
                  </div>
                  <div class="col s6 ">
                    <h5 class="center indigo-text darken-4" id="h6Articulo">Pts: <span id="tTotalPuntos"></span></h5>
                  </div>
              </div>
              <br>
              <table class="table striped RobotoR" id="tbl_trasn">
                  <thead>
                  <tr>
                      <th >CODIGO</th>
                      <th>FECHA</th>
                      <th>PUNTOS DISP.</th>
                  </tr>
                  </thead>
                  <tbody class="Centrado">

                  </tbody>
              </table>
    </div>
    <!-- <div class="modal-footer">
    </div> -->


