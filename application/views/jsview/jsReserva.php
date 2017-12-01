<script>
$(document).ready(function(){
    $("#searchCatalogo").on('keyup',function(){
        var table = $('#tblArticulos').DataTable();
        table.search(this.value).draw();
    });

});
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
    },
    initComplete: function () {
        this.api().columns([15]).every( function () {
            var column = this;
            var select = $('<select><option value="">ESTADOS...</option></select>')
                .appendTo( $("#lstEstados").empty() )
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
</script>