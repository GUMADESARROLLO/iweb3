<header class="demo-header mdl-layout__header ">
    <div class="centrado  ColorHeader"><span class=" title">UNIMARK S.A - SUPLIENDO SALUD</span></div>
</header>
<main class="mdl-layout__content mdl-color--grey-100">

    <div class="mdl-grid demo-content">
        <div class="row">

            <div class="col s12 m12">
                <div class=" hoverable horizontal">
                    <div class="row" style="margin-top: 20px">
                        <div class="col s10 m8">
                            <i class="material-icons prefix">search</i>
                            <input type="text" id="searchCatalogo">
                        </div>
                        <div class="col s4 m4" style="margin-top: 10px">
                            <select class="browser-default" id="slt_bodegas" >
                                <?php
                                  if(!$lstBodega ){
                                   }else{
                                       foreach($lstBodega as $key){
                                           echo '<option value='.$key["BODEGA"].'>'.$key["BODEGA"].' | '.$key["NOMBRE"].'</option>';
                                       }
                                   }
                                ?>
                            </select>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="width:100%">
            <div STYLE="margin-right: 10px;" class="right m12" id="lstProveedores"></div>
        <div class="row center">
            <table class="table striped RobotoR" id="tblArticulos">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Descripcion</th>
                        <th>Laboratorio</th>
                        <th>Bodega</th>
                        <th>Lote</th>
                        <th>Existencia</th>
                        <th>Fecha Entrada</th>
                        <th>Fecha Vencimiento</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
  </div>
</div>
</main>

