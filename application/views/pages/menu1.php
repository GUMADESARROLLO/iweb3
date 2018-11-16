<div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
    <div class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
        <img style="margin-top: 50px;" width="100%" src="<?PHP echo base_url();?>assets/img/logoUMK.png"  >
        <header id="MenuFondo" class="demo-drawer-header">
            <div id="user" class="row">
                <div class="col l2 center carita">
                  <i class=" material-icons">face</i>
                </div>
                <div class="col l10 center">
                  <span class="Loggen"><?php echo $this->session->userdata('UserN');?></span>
                </div>
            </div>

        </header>


        <?php
        if($this->uri->segment(1)=="Main"){
            echo '';
        }else{

        }
        ?>
       <div id="menu">
           <ul class="nav menu demo-navigation mdl-navigation__link RobotoR " >
               <a href="Main" id="Main"><li href="Main"><i class="material-icons">home</i> inventario</li></a>
               <a href="Main2"><li href="Main2"><i class="material-icons">home</i> inventario</li></a>
               <a href="PUNTOS"> <li href="PUNTOS"><i class="material-icons">assignment</i> PUNTOS</li></a>
               <a href="Main"><li href="Main"><img src="<?php echo base_url("assets/img/icon_stat.png")?>"></a>
               <a href="6Meses"> <li href="6Meses"><i class="material-icons">attach_money</i> liquidacion a 6 meses</li></a>
               <a href="12Meses"> <li href="12Meses"><i class="material-icons">monetization_on</i> liquidacion a 12 meses</li></a>
               <a href="Reserva"> <li href="Reserva"><i class="material-icons">lock</i> Reserva</li></a>
               <a href="InvBodega"> <li href="InvBodega"><i class="material-icons">assignment</i> INV. POR BODEGA</li></a>
               <a href="Usuarios"> <li href="Usuarios"><i class="material-icons">account_box</i> usuarios</li></a>
               <a href="#" onclick="modalPass()"> <li href="#"><i class="material-icons">lock</i> Cambiar Contraseña</li></a>
               <li><a onclick="ModalInfo()" href="javascript:void(0)"><i class="material-icons">info</i> Acerca de</a></li>\';
               <a href="#" > <li href="#" id="Salir"><i class="material-icons">exit_to_app</i> cerrar sesión</li></a>


          </ul>
       </div>
    </div>

               <!-- Modal ChangePassword Structure -->
  <div id="modalPassword" class="modal">
    <div class="modal-content">
      <h4 class="center indigo-text darken-4">CAMBIAR CONTRASEÑA</h4>
      <br>
     <div class="container">
      <div class="input-field col s6 m6 s6">
        <input type="hidden" name="idUser" id="idUser" value="<?php echo $this->session->userdata('id');?>">
        <input type="password" id="newPass" name="newPass" placeholder="Escribe la nueva contraseña">
        <label for="lblnewPass" id="lblnewPass">Nueva Contraseña</label>  
      </div>
     <p>
      <input type="checkbox" id="showPass" class="filled-in"/>
      <label for="showPass" id="lblshowPass">Mostrar Contraseña</label>
    </p>
    </div>
     </div>
    <div class="center">
       <a href="#!" onclick="actualizaPass()" class="waves-effect waves-light btn blue">ACEPTAR</a>
      <a href="#!" class="modal-action modal-close waves-effect waves-red btn red">CERRAR</a>
    </div>
    <br>
  </div>