<header class="demo-header mdl-layout__header ">
    <div class="centrado  ColorHeader"><span class=" title">USUARIOS</span></div>
</header>

<main class="mdl-layout__content mdl-color--grey-100">
    <div class="mdl-grid demo-content">       
        <div class="row TextColor center">LISTA DE USUARIOS</div>
        
        <div class="row" style="width:100%">
          <div class="container">
            <div class="Buscar row column">               
              <div class="col s1 m1 l1 offset-l3 offset-m2"><i onclick="ekisde()" class="material-icons ColorS">search</i></div>
                <div class="input-field col s11 m6 l5">
                    <input  id="searchUsuarios" type="text" placeholder="Buscar" class="validate mayuscula">
                    <label for="search"></label>
                </div>
            </div>
          </div>

          <a href="#" onclick="ModalUser()" class="btn waves-effect waves-light blue right">Nuevo</a>

        <div class="row center">
            <table class="table striped" id="tblUsuarios">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Empresa</th>
                        <th>VendedorCod</th>
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
                                        <a  href='#' onclick='setDominios(".'"'.$key['idtblusers'].'"'.")'><i class='material-icons'>delete</i></a>
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
</main>

 <!-- Modal Structure -->
  <div id="modalUsuarios" class="modal">
    <div class="modal-content">
      <h4 class="center indigo-text darken-4">Registrar Usuario</h4><br>
      <div class="row">
          <div class="input-field col s6 m6 s6">
               <input type="text" id="CodVend" name="CodVend" placeholder="Codigo Vendedor">
               <label for="lblCodVend" id="lblCodVend">Codigo Vendedor</label>               
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
               <label for="lblUsername" id="lblUsername">Nombre de usuario</label>               
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