<script>
$(document).ready(function()
{
    $("#searchCatalogo").on('keyup',function(){
        var table = $('#tblArticulos').DataTable();
        table.search(this.value).draw();
    });
    $( "#slt_bodegas").change(function() {
        /*var table = $('#tblArticulos').DataTable();
        table.page.len(this.value).draw();*/



    });

});

function vst(ID) {
    $("#crd002,#crd004,#crd006").removeClass('blue lighten-5');
    var ths = $("#crd"+ID);
    ths.addClass('blue lighten-5');
    (ths.hasClass('blue lighten-5') ) ? ths.removeClass('blue lighten-5'): ths.addClass('blue lighten-5');

    $("#tblArticulos").dataTable({
        responsive: true,
        "autoWidth":false,
        "ajax": "getInvBodegas/"+ID,
        "destroy": true,
        "paging":   true,
        "dom": 'T<"clear">lfrtip',
        "tableTools": {
            "sSwfPath": "<?php echo base_url(); ?>assets/data/swf/copy_csv_xls_pdf.swf",
        },
        "columns":[
            { "data": "ARTICULO" },
            { "data": "NOMBRE" },
            { "data": "LABORATORIO" },
            { "data": "BODEGA" },
            { "data": "LOTE" },
            { "data": "CANT_DISPONIBLE" },
            { "data": "FECHA_ENTRADA" },
            { "data": "FECHA_VENCIMIENTO" }
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

$("#tblArticulos").DataTable( {
    responsive:true,
    "autoWidth":false,
    "info": false,
    "scrollY": 600,
    "scrollX": true,
    "scrollCollapse": true,
    "sort":true,
    "dom": 'T<"clear">lfrtip',
    "tableTools": {
        "sSwfPath": "<?php echo base_url(); ?>assets/data/swf/copy_csv_xls_pdf.swf",
    },
    "pagingType": "full_numbers",
    "lengthMenu": [
        [5,100, -1],
        [5,100, "Todo"]
    ],
    "language": {
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
    }
} );
$( "#tblArticulos_length" ).hide();
</script>