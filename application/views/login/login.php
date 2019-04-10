
<div style="width: 100%; background: #263b47" id="cont-login-1">
    <div class="row" style="margin-bottom: 0px!important; ">
        <div class="col s7">
            <img src="<?php echo base_url();?>assets/img/logoUMK.png" style="width:20%; margin-top: 8px;">
        </div>        
        <div class="col s5">
            <div class="row" style="margin-bottom: 0px!important">
                <form action="<?php echo base_url("index.php/login");?>" method="post" class="form">
                    <div class="col s4">
                        <input placeholder="Usuario" name="txtUsuario" autocomplete="off" id="nombre" type="text" class="login-input">
                    </div>
                    <div class="col s4">
                        <input placeholder="Contraseña" name="txtpassword" autocomplete="off" id="pass" type="password" class="login-input">
                    </div>
                    <div class="col s4">
                        <button id="Acceder" class="btn-login" type="submit" name="action">Acceder</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row" style="margin-top: 0px; bottom: 2%; position: fixed; top: 62px" id="img-login-1">
    <div class="col s12" style="padding: 0px 0px 0px 0px!important; height: 100%">
      <div class="slider" >
        <ul class="slides" style="background: transparent!important">
          <li style="height: 100%!important">
            <img src="<?php echo base_url('assets/img/f1.png')?>">
          </li>
          <li style="height: 100%!important">
            <img src="<?php echo base_url('assets/img/f2.png')?>">
          </li>
          <li style="height: 100%!important">
            <img src="<?php echo base_url('assets/img/f3.png')?>">
          </li>
          <li style="height:100%!important">
            <img src="<?php echo base_url('assets/img/f4.png')?>">
          </li>
        </ul>
      </div>
    </div>
</div>
<div class="row" style="margin-top: 100px;" id="cont-login-2">
  <div class="col s12">
    <div class="card" style="width: 90%; padding: 20px; margin: 0 auto">
      <div class="card-content">
        <form action="<?php echo base_url("index.php/login");?>" method="post" class="form">
          <div class="row center">
            <div class="col s12">
              <img  src="<?PHP echo base_url();?>assets/img/unimark.png" style="width:80%" >
            </div>                 
          </div>
          <div  class="row center">
            <div class="col s12">  
              <input style=""  placeholder="USUARIO" name="txtUsuario" id="nombre" type="text" class="login-input">
            </div>
          </div>
          <div class="row">
            <div class="col s12">
              <input style="" placeholder="CONTRASEÑA" name="txtpassword" id="pass" type="password" class="login-input">
            </div>
          </div>
          <div class="row center">
            <div class="col s12">
              <button id="Acceder" class="btn-login" type="submit" name="action">ACCEDER</button>
            </div>                
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

