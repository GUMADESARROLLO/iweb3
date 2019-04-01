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
        "ajax": "ajax_Disp_Clientes" ,
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
            { "data": "CLIENTE" },
            { "data": "NOMBRE" },
            { "data": "DIRECCION" },
            { "data": "LIMITE_CREDITO" },
            { "data": "CREDITODISP" },
            { "data": "SALDO" },
            { "data": "ESTADOACTUAL" },
            { "data": "VENDEDOR" },
            { "data": "MOROSO" }
        ],
        fnRowCallback: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
            $('td', nRow).css('background-color', aData['MOROSO'] === "S" ? '#F44336' : '');
        },
        initComplete: function () {
            this.api().columns([8]).every( function () {
                var column = this;

               $('#frm_mora').on( 'change', function () {
                    var val = $.fn.dataTable.util.escapeRegex($(this).val());
                    column.search( val ? '^'+val+'$' : '', true, false ).draw();
                } );
            } );

            this.api().columns([7]).every( function () {
                var column = this;

                var select = $('#frm_ruta_row').on( 'change', function () {
                    var val = $.fn.dataTable.util.escapeRegex($(this).val());
                    column.search( val ? '^'+val+'$' : '', true, false ).draw();
                } );
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );


                $("#id_span_count_item").html(this.data().count()+" Clientes");



            } );



            $("#tblCatalogos_length").hide();
        }
    } );
});

</script>