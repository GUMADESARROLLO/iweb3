<script>
        var id_print = window.location.href.substr(window.location.href.lastIndexOf("/")+1);

        $("#modalIdArticulo").html(id_print);

        $('#tblArticulos').DataTable( {
            "ajax": "../ajax_getTransac/" + id_print  ,
            responsive:true,
            "autoWidth":false,
            "destroy": true,
            //stateSave: true,
            "info": false,
            "sort":false,

            "lengthMenu": [
                [100,1000, -1],
                [10,100, "Todo"]
            ],
            "order": [
                [2, "asc"]
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
                    this.data().each( function ( d, j ) {
                        tTotal += parseInt(d.replace(",",""));

                    } );
                } );
                $("#tTotalPuntos").html(tTotal);
                
                $("#tblArticulos_length,#tblArticulos_paginate").hide();
                window.print();
            }
        } );


       

</script>