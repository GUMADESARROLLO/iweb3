<header class="demo-header mdl-layout__header ">
    <div class="centrado  ColorHeader"><span class=" title">LIQUIDACION A 6 MESES</span></div>
</header>

<main class="mdl-layout__content mdl-color--grey-100">
    <div class="mdl-grid demo-content">       
        <div class="row TextColor center">LISTA DE ARTICULOS</div>
        
        <div class="row" style="width:100%">
          <div class="container">
            <div class="Buscar row column">               
              <div class="col s1 m1 l1 offset-l3 offset-m2"><i onclick="ekisde()" class="material-icons ColorS">search</i></div>
                <div class="input-field col s11 m6 l5">
                    <input  id="search6meses" type="text" placeholder="Buscar" class="validate mayuscula">
                    <label for="search"></label>
                </div>
            </div>
          </div>
        <div class="row center" style="overflow-x:auto;" >
            <table class="table striped RobotoR" id="tbl6Meses">
                <thead>
                    <tr>
                        <th>ARTICULO</th>
                        <th>DESCRIPCION</th>
                        <th>DIAS VENCIMIENTOS</th>
                        <th>CANT. DISPONNIBLE</th>
                        <th>FECHA VENCIMIENTO</th>
                        <th>LOTE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(!$liq6mes)
                        {}
                            else{
                                foreach ($liq6mes as $key) {
                                    echo '
                                    <tr>
                                        <td>'.$key['ARTICULO'].'</td>
                                        <td>'.$key['DESCRIPCION'].'</td>
                                        <td>'.$key['DIAS_VENCIMIENTO'].'</td>
                                        <td>'.number_format($key['CANT_DISPONIBLE'],2).' - [ '.$key['UNIDAD_VENTA'].' ]' .'</td>
                                        <td>'.date('d/m/Y',strtotime($key['fecha_vencimientoR'])).'</td>                                      
                                        <td>'.$key['LOTE'].'</td>';
                                }
                            }
                    ?>
                </tbody>
            </table>
        </div>
  </div>
</div>
</main>