<header class="demo-header mdl-layout__header ">
    <div class="centrado  ColorHeader">
      <span class=" title">USUARIOS</span>
        <a href="#!" style="float: left; margin-left: 1rem; color: white" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    </div>
</header>

<div class="container" style="width: 100%!important;">
  <div class="card">
    <div class="card-content">
      <div class="row">
        <div class="col s12 m10">
          <div class="input-group" style="margin-top: 0px!important">
            <span class="input-group-addon"><i class="small material-icons">search</i></span>
            <input  id="searchUsuarios" type="text" placeholder="Buscar usuario" class="validate mayuscula">
          </div>  
          
        </div>
        <div class="col s12 m2">
          <a href="#" onclick="ModalUser()" class="btn waves-effect waves-light blue right">Nuevo</a>
        </div>
      </div>
      <div class="row">
        <div class="col s12 m12">
            <table class="table striped" id="tblUsuarios">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Empresa</th>
                        <th>Nombre</th>
                        <th>Fecha Registro</th> 
                        <th>Privilegio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(!$Usuarios)
                        {
                        }else{
                            foreach ($Usuarios as $key) {
                                echo "
                                    <tr>
                                        <td>".$key["Username"]."</td>
                                        <td>".$key["IDempresa"]."</td>
                                        <td>".$key["VendedorCod"]."</td>
                                        <td>".$key["DateCreado"]."</td>
                                        <td>".$key["privi"]. "</td>
                                        <td>
                                        <a class='tooltipped' data-tooltip='eliminar ".$key['Username']."' data-position='left' href='#' id='".$key['idtblusers']."' onclick='eliminaUsuario(".'"'.$key['idtblusers'].'"'.")'><i class='material-icons'>delete</i></a>
                                        <a  href='#' onclick='setDominios(".'"'.$key['idtblusers'].'"'.")'><i class='material-icons'>settings</i></a>
                                        </td>
                                    </tr>
                                ";
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
</div>



 <!-- Modal Structure -->
  <div id="modalUsuarios" class="modal">
    <div class="modal-content">
      <h4 class="center indigo-text darken-4">Registrar Usuario</h4><br>
      <div class="row">
          <div class="input-field col s6 m6 s6">
               <input type="text" id="CodVend" name="CodVend" placeholder="Nombre Usuario">
               <label for="lblCodVend" id="lblCodVend">Nombre </label>               
          </div>
          <div class="input-field col s6 m6 s6">
               <input type="text" id="Empresa" name="Empresa" placeholder="Empresa">
               <label for="lblEmpresa" id="lblEmpresa">Empresa</label>               
          </div>
        </div>
        <br>
        <div class="row">
           <div class="input-field col s6 m6 s6">
               <input type="text" id="Username" name="Username" placeholder="Nombre de usuario">
               <label for="lblUsername" id="lblUsername">Usuario</label>               
          </div>
           <div class="input-field col s6 m6 s6">
               <input type="password" id="Password" name="Password" placeholder="Contraseña">
               <label for="lblPassword" id="lblPassword">Contraseña</label>               
          </div>
          <div class="col s12 m12 s12">
              <br>
               <button onclick="GuardaUsuario()" type="button" class="btn waves-effect waves-light blue">Guardar</button>
               <button type="button" class=" modal-action modal-close btn waves-effect waves-light red">Cancelar</button>             
          </div>
      </div>
    </div>
  </div>

<!--MODAL privilegios-->
<div class="modal fade bd-example-modal-lg" id="mdl-privilegios" tabindex="-1" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Privilegio del usuario</h5>
                <span id="id_select_user" style="display: none">0</span>
            </div>


            <div class="modal-body">
                <div class="row">
                    <div class="col-sm" id="id-tabla">

                    </div>
                </div>

            </div>

        </div>
    </div>
</div>