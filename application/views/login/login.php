
<div class="col center s12 l5">
 <form action="<?php echo base_url("index.php/login");?>" method="post" class="form">
         <div class="row login-logo center" style="color:white;width: 600px!important;">
             <img  src="<?PHP echo base_url();?>assets/img/logoUMK.png" style="width:100%;height:100%;" >
        </div>
        <div  class="row">
            <div class="col s10 m10 l6 offset-l3 offset-m1 offset-s1">  
                <input style="width: 80%; margin-top: 34px;"  placeholder="USUARIO" name="txtUsuario" id="nombre" type="text" class=" validate">
            </div>
        </div>
        <div class="row">
            <div class="col s10 m10 l6 offset-l3 offset-m1 offset-s1">
                <input style="width: 80%;" placeholder="CONTRASEÑA" name="txtpassword" id="pass" type="password" class="validate">
            </div>
        </div>

        <div class="row center">
            <button id="Acceder" class="btn" type="submit" name="action">ACCEDER</button>
        </div>

   </form>
</div>
