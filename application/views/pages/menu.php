<?php $name = $this->session->userdata('UserN');?>
<!--<div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
    <div class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
        <img style="margin-top: 50px;" width="100%" src="<?PHP echo base_url();?>assets/img/logoUMK.png"  >
        <header id="MenuFondo" class="demo-drawer-header">
            <div id="user" class="row">
                <div class="col l2 center carita">
                  <i class=" material-icons">face</i>
                </div>
                <div class="col l10 center">
                  <span class="Loggen"><?php echo $name?></span>
                </div>
            </div>
        </header>
       <div id="menu">
           <ul class="nav menu demo-navigation mdl-navigation__link RobotoR" >
            <?php
            if ($List_menus!=0){
                foreach ($List_menus as $Keys){
                    if ($Keys['modules_id']=="Stat"){
                        echo '<a href="Stat"><li href="Stat"><img src="'.base_url("assets/img/icon_stat.png").'"></li></a>';
                    }else{
                        echo '<a href="'.$Keys['modules_id'].'"><li href="'.$Keys['modules_id'].'"><i class="material-icons">'.$Keys['Icons'].'</i> '.$Keys['Full_name'].'</li></a>';
                    }
                }
            }else{
                echo '<a href="!#"><li href="!#"><i class="material-icons">error_outline</i> Error 403</li></a>';
            }
            ?>
               <a href="#" onclick="modalPass()"> <li href="#"><i class="material-icons">lock</i> Cambiar Contraseña</li></a>
               <li><a onclick="ModalInfo()" href="javascript:void(0)"><i class="material-icons">info</i> Acerca de</li></a>\';
               <a href="#" > <li href="#" id="Salir"><i class="material-icons">exit_to_app</i> cerrar sesión</li></a>';
          </ul>
       </div>
    </div>-->

  <!--NUEVO MENU LATERAL-->
  <ul id="slide-out" class="sidenav" style="background: #003040; color: white">
    <li><div class="user-view">      
      <img style="width: 100%" src="<?php echo base_url();?>assets/img/logoUMK.png">
      <span><strong><?php echo $name?></strong></span>
      <a style="color:#fff9c4; float: right;" href="#" id="Salir">Cerrar sesión</a>
    </div></li>
      <?php
      if ($List_menus!=0){
          foreach ($List_menus as $Keys){
              if ($Keys['modules_id']=="Stat-"){
                  echo '<li><a href="Stat">Estadisticas de ventas</a></li>';
              }else{
                  echo '<li><a href="'.$Keys['modules_id'].'"><i class="material-icons">'.$Keys['Icons'].'</i>'.$Keys['Full_name'].'</a></li>';
              }
          }
      }else{
          echo '<li><a href="!#"><li href="!#"><i class="material-icons">error_outline</i> Error 403</li></a>';
      }?>
      <li><a href="#" onclick="modalPass()"><i class="material-icons">lock</i> Cambiar Contraseña</a></li>
      
  </ul>

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