<script>
$(document).ready(function(){
    $("#search6meses").on("keyup",function(){
        var table = $("#tbl6Meses").DataTable();
        table.search(this.value).draw();
    });

    $("#search12meses").on("keyup",function(){
        var table = $("#tbl12Meses").DataTable();
        table.search(this.value).draw();
    })
});

    $("#tbl6Meses,#tbl12Meses").dataTable({
    responsive:true,
     "autoWidth":false,
     "info": true,
                "sort":true,
                "order": [
                    [1, "asc"]
                ],
                "pagingType": "full_numbers",
                "lengthMenu": [
                    [10,100, -1],
                    [10,100, "Todo"]
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
                }
    });
</script>