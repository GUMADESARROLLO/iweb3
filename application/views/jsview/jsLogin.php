<script>
var vrUsuario,vrPassword;
if(localStorage.getItem("onLine")==="true"){
        vrUsuario =  localStorage.getItem("oUsuario");
        vrPassword =localStorage.getItem("oPassword");
        //LLAMAR LA FUNCION DE ACCESO
        Login(vrUsuario , vrPassword);
    }


$("#Acceder").on("click",function(){
     vrUsuario = $("#nombre").val(),
    vrPassword = $("#pass").val();
    Login(vrUsuario,vrPassword);
});


function Login(vrUsuario,vrPassword)
{
        var form_data = {
        txtUsuario:vrUsuario,
        txtpassword:vrPassword
    };
    $.ajax({
        url:"<?php echo base_url("index.php/login")?>",
        type:"POST",
        data:form_data,
        success:function(data){
            if(data){
                localStorage.setItem("onLine", true);
                localStorage.setItem("oUsuario", vrUsuario);
                localStorage.setItem("oPassword", vrPassword);
                window.location = "<?php echo base_url("index.php/Main")?>";
            }
            else{
                swal({
                    "title":"Error de autenticación",
                    "type":"error",
                    "text":"EL usuario y/o la contraseña son incorrectos",
                    "confirmButtonText":"CERRAR"
                });
            }
        }
    });
}


</script>