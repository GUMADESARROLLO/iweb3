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
        "ajax": "ajax_Stat" ,
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
            { "data": "BODEGA" },
            { "data": "LABORATORIO" },
            { "data": "ARTICULO" },
            { "data": "DESCRIPCION" },
            { "data": "ANNO" },
            { "data": "TOTAL_ART_VENDIDO" },
            { "data": "UNIDAD_VENDIDA_ANUAL" },
            { "data": "TOTAL_VENTA_ANUAL" },
            { "data": "PROMEDIO_VENTA_ANUAL" }
        ],
        initComplete: function () {
            this.api().columns([4]).every( function () {
                var column = this;
                var select = $('#frm_anno').on( 'change', function () {
                    var val = $.fn.dataTable.util.escapeRegex($(this).val());
                    column.search( val ? '^'+val+'$' : '', true, false ).draw();
                } );
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
                 $("#searchCatalogo").attr("placeholder", "Buscar entre "+this.data().count()+" articulos");
            } );
            $("#tblArticulos_length").hide();
        }
    } );
});



</script>