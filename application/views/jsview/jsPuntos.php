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
    $('.select2').select2();
    $("#tblArticulos_length").hide();
});



    $("#tblArticulos").DataTable( {
        responsive:true,
        "autoWidth":false,
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
        }
    } );

    function getTransac(elem,nombre) {
         $("#modalArtic").openModal({
             startingTop: '4%', // Starting top style attribute
             endingTop: '10%'
         });

        var id = $(elem).attr('id');

        $("#modalEncabezado").html(nombre);
        $("#modalIdArticulo").html(elem);

       /* $('#tbl_trasn').DataTable( {
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
        } );*/


        $('#tbl_trasn').DataTable( {
            "ajax": "ajax_getTransac/"  + elem,
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
                { "data": "mFactura" },
                { "data": "mFecha" },
                { "data": "mRemanente" }
            ],
            initComplete: function () {
                tTotal =0;
                $("#tTotalPuntos").html("...");
                this.api().columns([2]).every( function () {
                    //$("#searchCatalogo").attr("placeholder", "Buscar entre "+this.data().count()+" articulos");
                    this.data().each( function ( d, j ) {
                        tTotal += parseInt(d.replace(",",""));

                    } );
                } );
                $("#tTotalPuntos").html(tTotal);

                $("#tblArticulos_length").hide();
            }
        } );


    }
$("#btn_updte_existe").on("click",function () {
    swal({
            title: 'Actualizano existencias',
            onOpen: () => {
            swal.showLoading()
}
})
    $.ajax({
        url: "ALLPOINT",
        type: "POST",
        async: true,
        success: function (data) {
            if(true){
                swal({
                    text: "Cantidad actualizada!",
                    type: "success",
                    confirmButtonText: "aceptar"
                }).then(function () {
                    location.reload();
                });
            }else{
                swal({
                    text: "Ocurrio un error! Contáctese con el administrador",
                    type: "error",
                    confirmButtonText: "aceptar"
                }).then(function () {
                    location.reload();
                });
            }
        }
    });
});
</script>