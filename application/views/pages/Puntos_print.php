
<br>
<div class="container" style="width: 100%!important;">
  <div class="card">
    <div class="card-content">
        <img style="width: 10%" src="<?php echo base_url();?>assets/img/Logo-Visys-color.png">
      <div class="row">
        <div class="col s12 m12">
            <h4 class="center indigo-text darken-4" id="modalEncabezado"><?php echo $CLIENTES['data'][0]['CLIENTE']. ' - ' . $CLIENTES['data'][0]['NOMBRE'] ; ?></h4>
            <p class="Centrado"><?php echo$CLIENTES['data'][0]['DIRECCION'] ; ?></p>
            <p class="center indigo-text darken-4" id="h6Articulo">  <span id="tTotalPuntos"> </span> Pts.</p>
            <br>
            <table class="table striped RobotoR" id="tblArticulos">
                <thead>
                <tr>
                    <th>FACTURA</th>
                    <th>FECHA</th>
                    <th>PUNTOS DISP.</th>
                </tr>
                <tbody>

                </tbody>
            </table>
        </div>
      </div>
        <p class="center indigo-text darken-4">Impreso <?php echo date('d/m/Y h:i:s')?></p>
    </div>
  </div>
</div>




