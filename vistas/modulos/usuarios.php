<?php
$pdo = Conexion::conectar(); 

$stmt = $pdo->prepare("SELECT id, categorias FROM categorias");
$stmt->execute();
$sedes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Administrar usuarios
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> inicio</a></li>
            <li class="active">Administrar usuarios</li>
        </ol>
    </section>

        <!-- Main content -->
        <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">
                    Agregar usuario
                </button>
            </div>

            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
                          <thead>
                            <tr>
                                <th># </th>
                                <th>Nombre</th>
                                <th>Usuario</th>
                                <th>Perfil</th>
                                <th>Almacenes</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php 

                            $item=null;
                            
                            
                            $valor=null;


                            $usuarios=ControladorUsuarios::ctrMostrarUsuarios($item,$valor);


                            foreach ($usuarios as $key => $value) {

                                $nombreSede = $pdo->query("SELECT categorias FROM categorias WHERE id = {$value['categoria']}")->fetchColumn();

                                echo '

                                   <tr>

                                   <td>'.($key+1).'</td>
                                   <td>'.$value["nombre"].'</td>
                                   <td>'.$value["usuario"].'</td>
                                   <td>'.$value["perfil"].'</td>
                                   <td>'.$nombreSede.'</td>'; 
   
                                   if($value["estado"] != 0){

                            echo '<td><button class="btn btn-success btn-xs btnActivar" idUsuario="'.$value["id"].'" estadoUsuario="0">Activado</button></td>';

                        }else{

                            echo '<td><button class="btn btn-danger btn-xs btnActivar" idUsuario="'.$value["id"].'" estadoUsuario="1">Desactivado</button></td>';

                        }



                                echo '<td>

                                    <div class="btn-group">

                                        <button class="btn btn-primary btnEditarUsuario" idUsuario="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarUsuario">

                                            <i class="fa fa-pencil"></i>
                                        </button>


                                        <button class="btn btn-danger btnEliminarUsuario" idUsuario="'.$value["id"].'"  usuario="'.$value["usuario"].'">

                                            <i class="fa fa-times"></i>
                                        </button>


                                    </div>

                                </td>

                            </tr> ';
                                
                                                                                                                                                                                   

                            }
                        
                                                                              
                        ?>


                        </tbody>






                    </table>





                </div>

            </div>


        </section>

    </div>




    <!--=====================================
MODAL AGREGAR USUARIO
======================================-->
    <div id="modalAgregarUsuario" class="modal fade" role="dialog">

        <div class="modal-dialog">

            <div class="modal-content">


                <form role="form" method="post" enctype="multipart/form-data">

                    <!--=====================================
                    CABEZA DEL MODAL
                    ======================================-->


                    <div class="modal-header" style="background:#3c8dbc; color:white">

                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                        <h4 class="modal-title">Agregar usuario</h4>

                    </div>

                    <!--=====================================
                    CUERPO DEL MODAL
                    ======================================-->

                    <div class="modal-body">
                        <div class="box-body">

                            <!-- ENTRADA PARA EL NOMBRE -->

                            <div class="form-group">

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>

                                    <input type="text" class="form-control input-lg" name="nuevoNombre"
                                        placeholder="Ingresar nombre" required>

                                </div>

                            </div>

                            <!-- ENTRADA PARA EL USUARIO -->

                            <div class="form-group">

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                                    <input type="text" class="form-control input-lg" name="nuevoUsuario"
                                        placeholder="Ingresar usuario" id="nuevoUsuario" required>

                                </div>

                            </div>


                            <!-- ENTRADA PARA LA CONTRASEÑA -->

                            <div class="form-group">

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                                    <input type="password" class="form-control input-lg" name="nuevoPassword"
                                        placeholder="Ingresar contraseña" required>

                                </div>

                            </div>

                            <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->

                            <div class="form-group">

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-users"></i></span>

                                    <select class="form-control input-lg" name="nuevoPerfil">

                                        <option value="">-- Selecionar perfil --</option>

                                        <option value="Administrador">Administrador</option>

                                        <option value="Vendedor">Vendedor</option>

                                    </select>

                                </div>

                            </div>

                            <!-- ENTRADA PARA SELECCIONAR SU SEDE -->

                            <div class="form-group">
                                <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                <select class="form-control input-lg" name="sede">
                                    <option value="">-- Seleccionar Almacén --</option>
                                    <?php foreach ($sedes as $sede) : ?>
                                        <option value="<?php echo $sede['id']; ?>"><?php echo $sede['categorias']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        </div>

                    </div>

                    <!--=====================================
                    PIE DEL MODAL
                    ======================================-->

                    <div class="modal-footer">

                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                        <button type="submit" class="btn btn-primary">Guardar usuario</button>

                    </div>

                    <?php 

                    $crearUsuario=new ControladorUsuarios();
                    $crearUsuario->ctrCrearUsuario();
                    
                    
                    
                    ?>






                </form>

            </div>
        </div>
    </div>





    <!--=====================================
MODAL EDITAR USUARIO
======================================-->

    <div id="modalEditarUsuario" class="modal fade" role="dialog">

        <div class="modal-dialog">

            <div class="modal-content">

                <form role="form" method="post" enctype="multipart/form-data">

                    <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

                    <div class="modal-header" style="background:#3c8dbc; color:white">

                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                        <h4 class="modal-title">Editar usuario</h4>

                    </div>

                    <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

                    <div class="modal-body">

                        <div class="box-body">

                            <!-- ENTRADA PARA EL NOMBRE -->

                            <div class="form-group">

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>

                                    <input type="text" class="form-control input-lg" id="editarNombre"
                                        name="editarNombre" value="" required>

                                </div>

                            </div>

                            <!-- ENTRADA PARA EL USUARIO -->

                            <div class="form-group">

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                                    <input type="text" class="form-control input-lg" id="editarUsuario"
                                        name="editarUsuario" value="" readonly>

                                </div>

                            </div>

                            <!-- ENTRADA PARA LA CONTRASEÑA -->

                            <div class="form-group">

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                                    <input type="password" class="form-control input-lg" name="editarPassword"
                                        placeholder="Escriba la nueva contraseña">

                                    <input type="hidden" id="passwordActual" name="passwordActual">

                                </div>

                            </div>


                            <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->

                            <div class="form-group">

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-users"></i></span>

                                    <select class="form-control input-lg" name="editarPerfil">

                                        <option value="" id="editarPerfil"></option>

                                        <option value="Administrador">Administrador</option>

                                        <option value="Vendedor">Vendedor</option>

                                    </select>

                                </div>

                            </div>
                            <div class="form-group">

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-users"></i></span>

                                    <select class="form-control input-lg" name="editaralmacen">

                                    <option value="" id="editarPerfil"></option>

                                    <?php foreach ($sedes as $sede) : ?>
                                        <option value="<?php echo $sede['id']; ?>"><?php echo $sede['nombre']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            </div>
                        </div>
                    </div>

                    <!--=====================================
        PIE DEL MODAL
        ======================================-->

                    <div class="modal-footer">

                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                        <button type="submit" class="btn btn-primary">Modificar usuario</button>

                    </div>

                    <?php
                    
                    $editarUsuario=new ControladorUsuarios();
                    $editarUsuario->ctrEditarUsuario();
                    
                    
                    ?>





                </form>
            </div>
        </div>
    </div>

    <?php
                    
                    $eliminarUsuario=new ControladorUsuarios();
                    $eliminarUsuario->ctrBorrarUsuario();
                    
                    
                    ?>
