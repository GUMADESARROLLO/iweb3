<script>
$(document).ready(function(){
    changeTabs('1');

    
    $("#tblPuntos_length").hide();
});


function changeTabs(tipo) {
    
    var cliente = $('#CLIENTE').val();
    var contenido = "";

    $.ajax({
        url: '../tabs/' + tipo + '/' + cliente,
        type: "post",
        async: true,
        success: function(data) {
            switch (tipo) {                
                case "1":
                    $("#tbody1").empty();
                    $.each(JSON.parse(data), function(i, item) {
                        contenido += `
                        <tr>
                            <td class="td-1">
                              <ul class="collection" style="margin:0!important">
                                <li class="collection-item avatar">
                                  <img src="<?php echo base_url();?>assets/img/fac.png" class="circle">
                                  <span class="font-other"><strong>Factura:</strong> `+item['DOCUMENTO']+`</span>
                                  <p><strong>Vendedor:</strong> `+item['VENDEDOR']+` <br>
                                     <strong>Monto:</strong> C$ `+numeral(item['MONTO_DOCUMENTO']).format('0,0.00')+`
                                  </p>
                                  <p style="float: right"><strong>Fecha:</strong><span>`+item['FECHA_DOCUMENTO']+`</span></p>

                                  <a href="#!" onclick="detalleFactura('`+item['DOCUMENTO']+`')" class="btn modal-trigger secondary-content">Detalle</a>
                                </li>
                              </ul>
                            </td>
                        </tr>`;

                    });
                
                    $("#tbody1").append(contenido);
                    reiniciarDataTable(`#tblClientes`);                
                break;

                case "2":
                    $("#tbCanjes").empty();
                    $.each(JSON.parse(data), function(i, item) {
                        contenido += `
                        <tr>
                          <td class="td-1">
                            <ul class="collection" style="margin:0!important">
                              <li class="collection-item avatar">
                                <img src="<?php echo base_url();?>assets/img/reg.png" class="circle">
                                <span class="font-other">COD. FPRT: `+item['ID_FRP']+`</span>
                                <p>Fecha del canje: `+item['FECHA']+` <br>
                                  <strong>Puntos:</strong> `+item['PUNTOS']+`
                                </p>
                                <a href="#!" onclick="detalleCanje('`+item['ID_FRP']+`')" class="btn modal-trigger secondary-content">Detalle</a>
                              </li>
                            </ul>
                          </td>
                        </tr>`;

                    });
                
                    $("#tbCanjes").append(contenido);
                    reiniciarDataTable(`#tblPuntos`);   
                
                break;
            }
        }
    })
}

function detalleFactura( ID_DOC ) {
    $("#num_fac").text(`FACTURA #`+ID_DOC);
    $("#f_fact").text(`Cargando...`);
    $("#tbDetFact")
        .empty()
        .append(`<tr><td colspan='5'>Cargando...</td></tr>`);

    var contenido = f_fact = ''; var t_fact = 0;
    $.ajax({
        url: '../dtllFac/' + ID_DOC,
        type: "post",
        async: true,
        success: function(data) {
            
            $.each(JSON.parse(data), function(i, item) {
                f_fact = item['FECHA_FACTURA'];
                t_fact = t_fact + parseFloat(item['PRECIO_TOTAL']);

                contenido += `
                <tr>
                    <td>`+item['FACTURA']+`</td>
                    <td>`+item['NOMBRE_ARTICULO']+`</td>
                    <td>`+numeral(item['CANTIDAD']).format('0')+`</td>
                    <td>`+numeral(item['PRECIO_UNITARIO']).format('0,0.00')+`</td>
                    <td>`+numeral(item['PRECIO_TOTAL']).format('0,0.00')+`</td>
                </tr>`;
            });

            tFoot = `
            <tr>
                <td colspan='5' class='right-align'><strong>Total: C$ `+numeral(t_fact).format('0,0.00')+`</strong></td>
            </tr>`;

            $("#f_fact").text(`Fecha facturado: ` + f_fact);
            $("#tbDetFact")
            .empty()
            .append(contenido+tFoot);
        }
    })
    $("#modalFact").openModal();
}

function detalleCanje( ID_CANJ ) {

    $("#num_canj").text(`FRP #`+ID_CANJ);
    //$("#f_canj").text(`Cargando...`);
    
    $("#container-detll-canj")
        .empty()
        .append(`<p class="center-align">Cargando ...</p>`);

    var contenido = articulos_cont = type_1 = ''; var t_canj = 0;

    articulos_cont+=`
    <table class="display" style="width:100%">
                      <thead>
                          <tr>
                              <th width="10%">Cantidad</th>
                              <th width="10%">Articulo</th>
                              <th>Descripcion</th>
                          </tr>
                      </thead>
                      <tbody>`;



    contenido+=`<table class="display" style="width:100%">
                  <thead>
                      <tr>
                          <th width="10%">Factura</th>
                          <th width="10%">Fecha</th>
                          <th width="10%">Puntos</th>
                          <th width="10%">Aplicado</th>
                          <th width="10%">Disponible</th>
                          <th width="10%">Estado</th>
                      </tr>
                  </thead>
                  <tbody>`;

    $.ajax({
        url: '../dtllCanj/' + ID_CANJ,
        type: "post",
        async: true,
        success: function(data) {

            /*var art = JSON.parse(data).map(function (articulos) { return articulos.Descripcion });
            var sorted = art.sort();

            var unique = sorted.filter(function (value, index) {
                return value !== sorted[index + 1];
            });
            $.each(unique, function(ii, val) {
                articulos_cont += `
                    <li class="font-other" style="margin-top:20px;">`+val+`</li>`;
            });*/
            
            $.each(JSON.parse(data), function(i, item) {

                if (type_1!==item['IdArticulo']) {
                    articulos_cont+=`<tr>
                                        <td>`+item['Cantidad']+`</td>
                                        <td>`+item['IdArticulo']+`</td>
                                        <td>`+item['Descripcion']+`</td>
                                    </tr>`;

                    type_1 = item['IdArticulo'];
                }

                pts_disp = ( parseFloat(item['Puntos_1'])-parseFloat(item['Puntos']) );
                st = (item['Puntos_1']===item['Puntos'])? '<span class="font-other" style="color:green">Total</span>':'<span class="font-other" style="color:red">Parcial</span>';

                contenido+=`
                <tr>
                    <td>`+item['Factura']+`</td>
                    <td>`+item['Fecha']+`</td>
                    <td>`+numeral(item['Puntos_1']).format('0')+`</td>
                    <td>`+numeral(item['Puntos']).format('0')+`</td>
                    <td>`+pts_disp+`</td>
                    <td>`+st+`</td>
                </tr>`;

                t_canj = t_canj + parseFloat(item['Puntos'].replace(",", ""));


            });

            articulos_cont += `</tbody></table>`;
            contenido += `</tbody></table>`;

            $("#container-detll-canj")
                .empty()
                .append(`
                <div class="row">
                <div class="col s6">
                  <ul class="tabs">
                    <li class="tab col s3"><a class="active" href="#test1"><span style='font-size:12px!important'>Articulos canjeados</span></a></li>
                    <li class="tab col s3"><a href="#test2"><span style='font-size:12px!important'>Facturas</span></a></li>
                  </ul>
                </div>
                <div id="test1" class="col s12"><br>`+articulos_cont+`</div>
                <div id="test2" class="col s12"><br>`+contenido+`</div>
                </div>`);

            
$('.tabs').tabs();
            /*$("#f_canj").text(`Total puntos: ` + t_canj);
            $("#tbCanjesDetall")
            .empty()
            .append(contenido);*/
        }
    })






    $("#modalCanjes").openModal();
    
}

function reiniciarDataTable( ID ) {
    $(ID).dataTable().fnDestroy();

    $(ID).dataTable({
        "paging":   true,        
        "info": false,
        "pagingType": "full_numbers",
        "lengthMenu": [
            [3,10,100, -1],
            [3,10,100, "Todo"]
        ],
        "language": {
            "info": "Registro _START_ a _END_ de _TOTAL_ entradas",
            "infoEmpty": "Registro 0 a 0 de 0 entradas",
            "zeroRecords": "No se encontro coincidencia",
            "infoFiltered": "(filtrado de _MAX_ registros en total)",
            "emptyTable": "NO HAY DATOS DISPONIBLES",
            "lengthMenu": '_MENU_ ',
            "search": '<i class=" material-icons">search</i>',
            "loadingRecords": "",
            "paginate": {
                "first": "Primera",
                "last": "Última ",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    });

    $(ID+"_length").hide();
}

$("#rtClientes").click( function() {
    var base_url = window.location.origin + '/' + window.location.pathname.split ('/') [1] + '/';
    location.href=base_url+`index.php/Disp_Clientes`;
} )


</script>