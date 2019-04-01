<header class="demo-header mdl-layout__header ">
    <div class="centrado  ColorHeader">
        <span class=" title">Catálogos</span>
        <a href="#!" style="float: left; margin-left: 1rem; color: white" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    </div>
</header>
<style> table tr:nth-child(odd) {background-color: #fff !important;} </style>

<div class="container" style="width: 100%!important;">
    <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col s12 m10">
                    <div class="input-group" style="margin-top: 0px!important">
                      <span class="input-group-addon"><i class="small material-icons">search</i></span>
                      <input type="text" id="searchCatalogo" placeholder="Buscar Articulos">
                    </div>
                </div>
                <div class="col s12 m2">
                    <select class="browser-default" id="frm_lab_row">
                        <option value="10">10</option>
                        <option value="100">100</option>
                        <option value="-1">Todas las filas...</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m12">
                    <!--<span id="id_span_count_item"></span>-->
                    <table id="tblCatalogos">
                        <thead>
                        <tr></tr>
                        <tr></tr>
                        <tr></tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
