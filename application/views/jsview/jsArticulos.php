<script>
$(document).ready(function(){
    $( ".dataTables_info" ).addClass( ".dataTables_info RobotoR" );
    $("#searchCatalogo").on('keyup',function(){
        var table = $('#tblArticulos').DataTable();
        table.search(this.value).draw();
    });

    $("#searchTransac").on('keyup',function(){
        var table = $("#tblTransacciones").DataTable();  
        table.search(this.value).draw();
    });

      $("#searchBodega").on('keyup',function(){
        var table = $("#tblBodega").DataTable();  
        table.search(this.value).draw();
    });
    
      $("#searchLotes").on('keyup',function(){
        var table = $("#tblLotes").DataTable();  
        table.search(this.value).draw();
    });

});



    $("#tblArticulos").DataTable( {
        responsive:true,
        "autoWidth":false,
        "info": true,
        "sort":true,
        "dom": 'T<"clear">lfrtip',
        "tableTools": {
            "sSwfPath": "<?php echo base_url(); ?>assets/data/swf/copy_csv_xls_pdf.swf",
        },
        "pagingType": "full_numbers",
        "lengthMenu": [
            [10,100, -1],
            [10,100, "Todo"]
        ],
        "order": [
            [1, "asc"]
        ],
        "language": {
            "info": "Registro _START_ a _END_ de _TOTAL_ entradas",
            "infoEmpty": "Registro 0 a 0 de 0 entradas",
            "zeroRecords": "No se encontro coincidencia",
            "infoFiltered": "(filtrado de _MAX_ registros en total)",
            "emptyTable": "NO HAY DATOS DISPONIBLES",
            "lengthMenu": '_MENU_ ',
            "search": '<i class=" material-icons">search</i>',
            "loadingRecords": " ",
            "paginate": {
                "first": "Primera",
                "last": "Última ",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
        initComplete: function () {
            this.api().columns([3]).every( function () {
                var column = this;
                var select = $('<select><option value="">LABORATORIOS...</option></select>')
                    .appendTo( $("#lstProveedores").empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );

                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );

                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    } );

$("#blfooterMaster").hide();



function getTransac(elem,nombre) {
     $("#modalArtic").openModal();
      getBodega(elem);

      getPrecios(elem);
      getBonificados(elem);
    //$("#tblTrans").trigger("click");
    $("#tlBdg").trigger("click");
    $("#dropCount").append("");
    var id = $(elem).attr('id');
    $("#modalEncabezado").html(nombre);
    $("#modalIdArticulo").html(elem);
    $("#dropCount").empty();

    $('#tbl_trasn').DataTable( {
        responsive: true,
        "autoWidth":false,
        "info": true,
        "sort":true,
        "destroy": true,
        "pagingType": "full_numbers",
        "lengthMenu": [
            [5,10,100, -1],
            [5,10,100, "Todo"]
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
    } );
    $("#dropCount").append($("#tbl_trasn_length"));

}

$("#btnSearch").click(function() {

    var d1 = $("#dtn1").val();
    var d2 = $("#dtn2").val();
    var at = $("#modalIdArticulo").html();
    var tp = $( "#sltTipo option:selected" ).text();
    console.log(tp);
    $("#dropCount").empty();
    if (d1 =='' || d2==''){
        swal(
            'Oops...',
            "Algo salio mal",
            'error'
        )
    }else{
        $('#tbl_trasn').DataTable( {
            "ajax": "TransaccionesDetalles"+"/"+d1+"/"+d2+"/"+at+"/"+tp,
            responsive: true,
            "autoWidth":false,
            "info": true,
            "sort":true,
            "destroy": true,
            "pagingType": "full_numbers",
            "lengthMenu": [
                [5,10,100, -1],
                [5,10,100, "Todo"]
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
            },
            "columns": [
                { "data": "FECHA" },
                { "data": "LOTE" },
                { "data": "DESCRTIPO" },
                { "data": "CANTIDAD" },
                { "data": "REFERENCIA" }
            ]
        } );
        $("#dropCount").append($("#tbl_trasn_length"));
    }
});


function getBodega(elem) {
    $("#tblBodega").dataTable({
        responsive: true,
        "autoWidth":false,
        "ajax": "Bodegas"+"/"+elem,
        "destroy": true,
        "columns":[
            {
                "className":      'detalles-Lotes',
                "orderable":      false,
                "data":           "DETALLE",
                "defaultContent": ''
            },
            { "data": "BODEGA" },
            { "data": "NOMBRE" },
            { "data": "CANT_DISPONIBLE" }
        ],
        "info": true,
        "pagingType": "full_numbers",
        "lengthMenu": [
            [5,10,100, -1],
            [5,10,100, "Todo"]
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
}



$('#tblBodega').on('click', 'td.detalles-Lotes', function () {
    var table = $('#tblBodega').DataTable();
    var tr = $(this).closest('tr');
    var row = table.row(tr);
    var attx = $("#modalIdArticulo").html();


    var data = table.row( $(this).parents('tr') ).data();
    if ( row.child.isShown() ) {
        row.child.hide();
        tr.removeClass('shown');
        console.log("close");
    }
    else {
        format(row.child,data.BODEGA,attx);
        tr.addClass('shown');
    }

});

function format(callback,bodega,art) {
    var ia=0;
    $.ajax({
        url:'Lotes/'+bodega+"/"+art,
        dataType: "json",
        complete: function (response) {
            var data = JSON.parse(response.responseText);

            var thead = '',  tbody = '';
            for (var key in data) {
                thead += '<th class="negra center">LOTE</th>';
                thead += '<th class="negra center">CANT. DISPONIBLE</th>';
                thead += '<th class="negra center">CANT. INGRESADA POR COMPRA</th>';
                thead += '<th class="negra center">FECHA ULTM. INGRESO COMPRA</th>';
                thead += '<th class="negra center">FECHA DE CREACION</th>';
                thead += '<th class="negra center">FECHA VENCIMIENTO</th>';
            }
            $.each(data, function (i, d) {

                $.each(d, function (a, b) {
                    ia++;
                });

                for (var x=0; x<ia; x++) {

                    var ART = "'" + d[x]["ARTICULO"] + "'";
                    var lt = "'" + d[x]["LOTE"] + "'";

                    tbody += '<tr class="center">' +
                        '<td>' + d[x]["LOTE"] + '</td>'+
                        '<td class="negra">' + d[x]["CANT_DISPONIBLE"] + '</td>'+
                        '<td>' + d[x]["CANTIDAD_INGRESADA"] + '</td>'+
                        '<td><span onclick="Ingresos_lotes('+ART+','+lt+')">' + d[x]["FECHA_INGRESO"] + '</span>*</td>'+
                        '<td>' + d[x]["FECHA_ENTRADA"] + '</td>'+
                        '<td>' + d[x]["FECHA_VENCIMIENTO"] + '</td>'+
                        '</tr>';
                }
            });
            callback($('<table id="tbl_detalles_bodegas">' + thead + tbody + '</table>')).show();
        },
        error: function () {
            swal(
                'Oops...',
                'Hubo un error al cargar los detalles!',
                'error'
            )
        }
    });
}

function Ingresos_lotes(ARTICULO,LOTE) {
    $("#mdlIngresos").openModal({
            ready: function (modal,tigger) {
                $("#tbl_ingresos_lote").dataTable({
                    responsive: true,
                    "autoWidth":false,
                    "ajax": "Ingresos"+"/"+ARTICULO+"/"+LOTE,
                    "destroy": true,
                    "columns":[
                        { "data": "FECHA_ENTRADA" },
                        { "data": "CANTIDAD_INGRESADA" }
                    ],
                    "info": true,
                    "pagingType": "full_numbers",
                    "lengthMenu": [
                        [5,10,100, -1],
                        [5,10,100, "Todo"]
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
        }
    });


}

function getPrecios(elem) {
    $("#Precio").html('');
    $("#Precio").html('<table  id="tblprecios" class="table striped compact" cellspacing="0"><thead><tr></tr></thead></table>');
    var data,
        tableName = '#tblprecios',
        columns,
        str,
        jqxhr = $.ajax("Precios"+"/"+elem)
        .done(function () {
            data = JSON.parse(jqxhr.responseText);
            $.each(data.columns, function (k, colObj) {
                str = '<th>' + colObj.name + '</th>';
                $(str).appendTo(tableName + '>thead>tr');
            });
            data.columns[0].render = function (data, type, row) {
                return data;
            }
            $(tableName).dataTable({
                responsive: true,
                "autoWidth":false,
                "data": data.data,
                "columns": data.columns,
                "info": true,
                "sort":true,
                "order": [
                    [1, "asc"]
                ],
                "pagingType": "full_numbers",
                "lengthMenu": [
                    [5,10,100, -1],
                    [5,10,100, "Todo"]
                ],
                "language": {
                    "info": "Registro _START_ a _END_ de _TOTAL_ entradas",
                    "infoEmpty": "Registro 0 a 0 de 0 entradas",
                    "zeroRecords": "No se encontro coincidencia",
                    "infoFiltered": "(filtrado de _MAX_ registros en total)",
                    "emptyTable": "NO HAY DATOS DISPONIBLES",
                    "lengthMenu": '_MENU_ ',
                    "search": '<i class=" material-icons">search</i>',
                    "loadingRecords": "Cargando...",
                    "paginate": {
                        "first": "Primera",
                        "last": "Última ",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
                "fnInitComplete": function () {
                    $('#tblprecios').on('init.dt', function () {
                        $("#load").hide();
                    }).dataTable();
                }
            });
        });
}

function getBonificados(elem) {
    $("#bonificados").html('');
    $("#bonificados").html('<table  id="tblbonificados" class="table striped compact" cellspacing="0"><thead><tr></tr></thead></table>');
    var data,
        tableName = '#tblbonificados',
        columns,
        str,
        jqxhr = $.ajax("Bonificados"+"/"+elem)
        .done(function () {
            data = JSON.parse(jqxhr.responseText);
            $.each(data.columns, function (k, colObj) {
                str = '<th>' + colObj.name + '</th>';
                $(str).appendTo(tableName + '>thead>tr');
            });
            data.columns[0].render = function (data, type, row) {
                return data;
            }
            $(tableName).dataTable({
                responsive: true,
                "autoWidth":false,
                "data": data.data,
                "columns": data.columns,
                "info": true,
                "sort":true,
                "order": [
                    [0, "asc"]
                ],
                "pagingType": "full_numbers",
                "lengthMenu": [
                    [5,10,100, -1],
                    [5,10,100, "Todo"]
                ],
                "language": {
                    "info": "Registro _START_ a _END_ de _TOTAL_ entradas",
                    "infoEmpty": "Registro 0 a 0 de 0 entradas",
                    "zeroRecords": "No se encontro coincidencia",
                    "infoFiltered": "(filtrado de _MAX_ registros en total)",
                    "emptyTable": "N/D",
                    "lengthMenu": '_MENU_ ',
                    "search": '<i class=" material-icons">search</i>',
                    "loadingRecords": "Cargando...",
                    "paginate": {
                        "first": "Primera",
                        "last": "Última ",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
                "fnInitComplete": function () {
                    $('#tblbonificados').on('init.dt', function () {
                        $("#load").hide();
                    }).dataTable();
                }
            });
        });
}
</script>