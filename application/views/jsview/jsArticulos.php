<script>
$(document).ready(function(){
    $("#searchCatalogo").on('keyup',function(){
        var table = $('#tblArticulos').DataTable();
        table.search(this.value).draw();
    });
    $( "#frm_lab_row").change(function() {
        var table = $('#tblArticulos').DataTable();
        table.page.len(this.value).draw();
    });
    $( "#frm_Item_row").change(function() {

        $('#tblArticulos').DataTable( {
            "ajax": "ajx_rutas/" + this.value,
            responsive:true,
            "autoWidth":false,
            "destroy": true,
            //stateSave: true,
            "info": false,
            "sort":true,
            "dom": 'T<"clear">lfrtip',
            "tableTools": {
                "sSwfPath": "<?php echo base_url("assets/data/swf/copy_csv_xls_pdf.swf"); ?>"
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
            "columns": [
                { "data": "CODIGO" },
                { "data": "DESCRI" },
                { "data": "PRECIO" },
                { "data": "BDG002" },
                { "data": "BDG006" },
                { "data": "PUNTOS" }
            ],
            initComplete: function () {
                this.api().columns([3]).every( function () {
                    $("#searchCatalogo").attr("placeholder", "Buscar entre "+this.data().count()+" articulos");
                } );
                $("#tblArticulos_length").hide();
            }
        } );
    });
    $('.select2').select2();
});



    $("#tblArticulos").DataTable( {
        responsive:true,
        "autoWidth":false,
        "destroy": true,
        //stateSave: true,
        "info": true,
        "sort":true,
        "dom": 'T<"clear">lfrtip',
        "tableTools": {
            "sSwfPath": "<?php echo base_url("assets/data/swf/copy_csv_xls_pdf.swf"); ?>"
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

                var select = $('#frm_lab_menu').on( 'change', function () {
                    var val = $.fn.dataTable.util.escapeRegex($(this).val());
                    column.search( val ? '^'+val+'$' : '', true, false ).draw();
                } );

                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
                $("#searchCatalogo").attr("placeholder", "Buscar entre "+this.data().count()+" articulos");


            } );
        }
    } );

    $("#tblArticulos_length").hide();

    $("#blfooterMaster").hide();


    $('#posts').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax":{
            "url": "<?php echo base_url('home/posts') ?>",
            "dataType": "json",
            "type": "POST",
            "data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
        },
        "columns": [
            { "data": "id" },
            { "data": "title" },
            { "data": "body" },
            { "data": "created_at" },
        ]

    });




    function getTransac(elem,nombre) {
         $("#modalArtic").openModal({
             startingTop: '4%', // Starting top style attribute
             endingTop: '10%'
         });
        getBodega(elem);

        getPrecios(elem);
        getBonificados(elem);
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
            "paging":   false,
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
            "info": false,
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
            $("#dv-"+data.BODEGA).hide();
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            $("#dv-"+data.BODEGA).show();
            format(row.child,data.BODEGA,attx);
            tr.addClass('shown');
        }

});

    function format(callback,bodega,art) {
        $.ajax({
            url:'Lotes/'+bodega+"/"+art,
            dataType: "json",
        complete: function (response) {
            var data = JSON.parse(response.responseText);
            var ia =0;
            var thead = '',  tbody = '';

            $("#dv-"+bodega).hide();

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
                        '<td>' + d[x]["FECHA_INGRESO"] + '</td>'+
                        '<td>' + d[x]["FECHA_ENTRADA"] + '</td>'+
                        '<td>' + d[x]["FECHA_VENCIMIENTO"] + '</td>'+
                        '</tr>';
                }
            });

            if (ia==0){
                thead += '<th class="negra center"></th>';
                tbody += '<tr class="center"><td>BODEGA SIN EXISTENCIA</td></tr>';
            }
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
                "paging":   false,
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
                "sort":false,
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