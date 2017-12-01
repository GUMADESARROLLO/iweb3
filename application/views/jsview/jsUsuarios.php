<script>
    $(document).ready(function(){
        $("#searchUsuarios").on("keyup",function(){
            var table = $("#tblUsuarios").DataTable();
            table.search(this.value).draw();
        });
    });

    $("#tblUsuarios").dataTable({
    responsive:true,
    "autoWidth":false,
     "info": false,
                "sort":true,
                "order": [
                    [3, "desc"]
                ],
                "pagingType": "full_numbers",
                "lengthMenu": [
                    [10,100, -1],
                    [10,100, "Todo"]
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
});

function ModalUser()
{
    $("#modalUsuarios").openModal();
}

function GuardaUsuario()
{
    var form_data = {
    CodVend: $("#CodVend").val(),
    Empresa:$("#Empresa").val(),
    Username: $("#Username").val(),
    Password:$("#Password").val() 
    };

    $.ajax({
        url:"GuardaUsuarios",
        data:form_data,
        type:"POST",
        async:true,
        beforeSend:function(){
            var Cod = $("#CodVend").val(),
            Emp = $("#Empresa").val(),
            user = $("#Username").val(),
            pass = $("#Password").val();

            if(Cod == "" || Emp == "" || user== "" || pass==""){
                swal({
                    "text":"Ooops! No puedes dejar campos vacíos",
                    "type":"warning",
                    "confirmButtonText":"CERRAR",
                    allowOutsideClick:false
                });
                $.ajax.abort();
            }
        },
        success:function(data){
            if("true"){
                swal({
                    "text":"Usuario registrado",
                    "type":"success",
                    "confirmButtonText":"ACEPTAR",
                    allowOutsideClick:false
                }).then(function(){
                    location.reload();
                });
            }else{
                swal({
                    "text":"Ocurrio un error al registrar el usuario, pongase en contacto con el administrador",
                    "type":"error",
                    "confirmButtonText":"ACEPTAR",
                    allowOutsideClick:false
                });
            }
        }
    });
}

function eliminaUsuario(elem)
    {
        var id = $(elem).attr("id");
    swal({
    title: 'Estas seguro que deseas eliminar este usuario?',
    text: "Esta operacion no se puede revertir!",
    type: 'warning',
    showCancelButton: true,
    cancelButtonColor: '#d33',
    confirmButtonText: 'SI, BORRAR!',
    cancelButtonText:"CANCELAR"
    }).then(function () {
        $.ajax({
            url:"EliminaUsuarios"+"/"+elem,
            type:"POST",
            async:true,
            success:function()
            {
                if(true){
                    swal({
                        "text":"Usuario Eliminado",
                        "type":"success",
                        "confirmButtonText":"ACEPTAR"
                    }).then(function(){
                        location.reload();
                    });
                }else{
                    swal({
                        "text":"Error al eliminar el usuario",
                        "type":"error",
                        "confirmButtonText":"CERRAR"
                    });
                }
            }
        });
    });
    }
</script>