<script>
$(document).ready(function(){
    $("#searchCatalogo").on('keyup',function(e){
        var table = $('#tblCatalogos').DataTable();
        table.search(this.value).draw();
        /* VALIDAR ENTER
        var code = (e.keyCode ? e.keyCode : e.which);
        if (code==13) {
        }
        */
    });
    $( "#frm_lab_row").change(function() {
        var table = $('#tblCatalogos').DataTable();
        table.page.len(this.value).draw();
    });



    $('#tblCatalogos').DataTable( {
        "ajax": "ajax_Catalogos" ,
        responsive:true,
        "autoWidth":false,
        "destroy": true,
        //stateSave: true,
        "info": false,
        "sort":true,
        "pagingType": "full_numbers",

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
            { "data": "Articulo" }
        ],
        initComplete: function () {
            this.api().columns([0]).every( function () {
                $("#id_span_count_item").html(this.data().count()+" articulos");
            } );

            $("#tblCatalogos_length").hide();
            $(".sorting_asc").hide()
        }
    } );
});



</script>