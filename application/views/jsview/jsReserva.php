<script>
$(document).ready(function()
{
    $("#searchCatalogo").on('keyup',function(){
        var table = $('#tblArticulos').DataTable();
        table.search(this.value).draw();
    });
    $( "#frm_lab_row").change(function() {
        var table = $('#tblArticulos').DataTable();
        table.page.len(this.value).draw();
    });

});
$("#mdlDetalles").on("click",function () {
    $("#ModalDetalles").openModal();
});

$('#tblArticulos').DataTable( {
    scrollX:        true,
    "fixedColumns":   {
        leftColumns: 7
    },
    responsive:true,
    stateSave: true,
    "autoWidth":false,
    "destroy": true,
    "dom": 'T<"clear">lfrtip',
    "tableTools": {
        "sSwfPath": "<?php echo base_url(); ?>assets/data/swf/copy_csv_xls_pdf.swf",
    },
    //stateSave: true,
    "info": false,
    "sort":true,
    "pagingType": "full_numbers",
    "lengthMenu": [
        [5,100, -1],
        [5,100, "Todo"]
    ],
    "order": [
        [0, "asc"]
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
    "columnDefs": [
        { "width": "50%", "targets": [ 1 ] }
    ],
    initComplete: function () {
        this.api().columns([15]).every( function () {
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

$( "#tblArticulos_length" ).hide();
$("#blfooterMaster").hide();
</script>