<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Historial de Pagos
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> inicio</a></li>
            <li class="active">Administrar pagos</li>
        </ol>
    </section>
            <section class="content">
            <div class="box">
            <div class="box-header with-border">
                <div class="input-group">
                    <input type="text" class="form-control" id="buscarProducto" placeholder="Buscar por fecha o descripción...">

                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i> Buscar
                        </button>
                    </span>
                </div>
            </div>

            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
                       
                           <thead>
                               <tr>
                                   <th style="width:10px">#</th>
                                   <th>Monto</th>
                                   <th>Descripcion</th>
                                   <th>Fecha/Hora</th>
                                   <th>Cliente</th>
                                   <th>Acciones</th>

                               </tr>

                           </thead>

                           <tbody>

                               <?php 

                            $item=null;
                            
                            
                            $valor=null;


                            $Pagos=ControladorPagos::ctrMostrarPagos($item,$valor);

                            $item2=null;
                            $valor2=null;
                            
                            $Clientes=ControladorClientes::ctrMostrarClientes($item2,$valor2);

                            foreach ($Pagos as $Pago => $value) {
                                echo '
                                    <tr>
                                        <td>' . ($Pago + 1) . '</td>  
                                        <td>' . $value["monto"] . '</td>
                                        <td>' . $value["Detalle"] . '</td>
                                        <td>' . $value["fechahora"] . '</td>
                                        <td>';
                            
                                $clienteEncontrado = array_filter($Clientes, function($cliente) use ($value) {
                                    return $cliente['id'] == $value['cliente'];
                                });
                            
                                if (!empty($clienteEncontrado)) {
                                    $clienteEncontrado = reset($clienteEncontrado);
                                    echo $clienteEncontrado['nombre']; 
                                } else {
                                    echo 'Cliente no encontrado';
                                }
                            
                                echo '</td>';
                           


                                echo '<td>

                                    <div class="btn-group">

                                        <button class="btn btn-warning btnEditarPagos" idPago="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarPago">
                                            <i class="fa fa-pencil"></i>
                                        </button>

                                        <button class="btn btn-danger btnEliminarPago" idPago="'.$value["id"].'"  pagos="'.$value["Detalle"].'">

                                            <i class="fa fa-times"></i>
                                        </button>

                                    


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

       <script>
            $(document).ready(function(){
                $("#buscarProducto").on("input", function() {
                    var valorBusqueda = $(this).val().toLowerCase();
                    $("tbody tr").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(valorBusqueda) > -1);
                    });
                });
            });
        </script>

        

<!--=====================================
MODAL EDITAR PAGO
======================================-->

<div id="modalEditarPago" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data">
                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Editar Pago</h4>
                </div>
                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->
                <div class="modal-body">
                    <div class="box-body">
                        <!-- ENTRADA PARA EL MONTO -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                <input type="text" class="form-control input-lg" id="editarMonto" name="editarMonto" value="<?php echo $value['monto']; ?>" required>
                            </div>
                        </div>
                        <!-- ENTRADA PARA LA DESCRIPCIÓN -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-comment"></i></span>
                                <input type="text" class="form-control input-lg" id="editarDescripcion" name="editarDescripcion" value="<?php echo $value['Detalle']; ?>" required>
                            </div>
                        </div>
                        <!-- ENTRADA PARA EL CLIENTE -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control input-lg" id="editarCliente" name="editarCliente" value="<?php echo $value['cliente']; ?>" required>
                            </div>
                        </div>
                    </div>
                </div>
                <!--=====================================
                PIE DEL MODAL
                ======================================-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Modificar Pago</button>
                </div>
                <?php
                // $editarPago = new ControladorPagos();
                // $editarPago->ctrEditarPago();
                ?>
            </form>
        </div>
    </div>
    </div>

    <?php 


$borraCliente=new ControladorPagos();
$borraCliente-> ctrEliminarPagos();
   
   
   ?>

