<header class="demo-header mdl-layout__header ">
    <div class="centrado  ColorHeader">
        <span class=" title">Inv. bodega</span>
        <a href="#!" style="float: left; margin-left: 1rem; color: white" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    </div>
</header>
<main class="mdl-layout__content mdl-color--grey-100">

    <div class="mdl-grid demo-content">
        <div class="row">
            <div class="col s12 m3">
                <div id="crd002" class="card hoverable">
                    <div class="card-content">
                        <a href="#"  onclick="vst('002')"><span class="card-title" style="font-size: 21px;">002 | BODEGA TIPITAPA<i class="material-icons right" style="margin-top: 10px">remove_red_eye</i></span></a>
                    </div>
                </div>
            </div>
            <div class="col s12 m5">
            <div id="crd004" class="card hoverable">
                <div class="card-content">
                    <a href="#"  onclick="vst('004')"><span class="card-title " style="font-size: 21px;">004 | BODEGA DAÑADOS Y VENCIDOS<i class="material-icons right" style="margin-top: 10px">remove_red_eye</i></span></a>
                </div>
            </div>
        </div>
            <div class="col s12 m4">
            <div id="crd006" class="card hoverable">
                <div class="card-content">
                    <a href="#"  onclick="vst('006')"><span class="card-title " style="font-size: 21px;">006 | BODEGA DISCASA<i class="material-icons right" style="margin-top: 10px">remove_red_eye</i></span></a>
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
