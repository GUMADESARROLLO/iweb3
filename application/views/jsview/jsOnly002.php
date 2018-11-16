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

    $('#tblArticulos').DataTable( {
        "ajax": "ajax_only002" ,
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
            { "data": "LABORATORIO" },
            { "data": "ARTICULO" },
            { "data": "DESCRIPCION" },
            { "data": "CANTIDAD_DISPONIBLE" }
        ],
        initComplete: function () {
            this.api().columns([3]).every( function () {
                $("#searchCatalogo").attr("placeholder", "Buscar entre "+this.data().count()+" articulos");
            } );
            $("#tblArticulos_length").hide();
        }
    } );
});



</script>