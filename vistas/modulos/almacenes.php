       <!-- Content Wrapper. Contains page content -->
       <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <section class="content-header">
           <h1>
             Administrar Almacenes
           </h1>
           <ol class="breadcrumb">
             <li><a href="#"><i class="fa fa-dashboard"></i> inicio</a></li>

             <li class="active">Administrar Almacenes</li>
           </ol>
         </section>

         <!-- Main content -->
         <section class="content">

           <!-- Default box -->
           <div class="box">
             <div class="box-header with-border">
               <div class="form-group">

                 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                   Distribuir Producto
                 </button>

                 <!-- Inicio Modal -->
                 <div class="modal fade" id="myModal" role="dialog">
                   <div class="modal-dialog">

                     <!-- Contenido del modal -->
                     <div class="modal-header" style="background:#3c8dbc; color:white">
                     <form role="form" method="post" enctype="multipart/form-data">

                       <button type="button" class="close" data-dismiss="modal">&times;</button>

                       <h4 class="modal-title">Administrar Por Almacenes</h4>

                     </div>
                     <div class="modal-content">

                       <div class="modal-body">
                         <div class="input-group">
                           <span class="input-group-addon"><i class="fa fa-th"></i></span>
                           <select class="form-control input-lg" id="productosede" name="productosede">
                             <option value="">-- Seleccionar Producto para su Distribución-- </option>
                             <?php
                              $productos = ControladorProductos::ctrMostrarProductos(null, null, null);
                              if ($productos) {
                                foreach ($productos as $producto) {
                                  echo '<option value="' . $producto["id"] . '">' . $producto["descripcion"] . " - Stock " . $producto["stock"] . '</option>';
                                }
                              } else {
                                echo '<option value="">No hay productos disponibles</option>';
                              }
                              ?>
                           </select>


                         </div>

                         <br>
                         <div class="box-body">
                           <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
                             <thead>
                               <tr>
                                 <th>#</th>
                                 <th>Almacenes</th>
                                 <th>Agregar</th>
                               </tr>
                             </thead>
                             <tbody>
                               <?php
                                $item = null;
                                $valor = null;
                                $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);
                                foreach ($categorias as $key => $value) {
                                  if ($value["categorias"] !== "Almacen Principal") {
                                      echo '<tr>';
                                      echo '<td>' . ($key + 1) . '</td>';
                                      echo '<td>' . $value["categorias"] . '</td>';
                                      echo '<td>';
                                      echo '<div class="btn-group">';
                                      echo '<input type="number" class="form-control" id="nuevacantidad' . $value["id"] . '" name="nuevacantidad' . $value["id"] . '" placeholder="Cantidad de Producto">';
                                      echo '</div>';
                                      echo '</td>';
                                      echo '</tr>';
                                  }
                              }
                                ?>
                             </tbody>
                           </table>
                         </div>
                       </div>
                       <div class="modal-footer">
                         <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                         <button type="submit" class="btn btn-primary" id="guardarCantidad">Guardar</button>
                       </div>
                       <?php

                        $crearInventario = new Controladorinventario();
                        $crearInventario->ctrCrearinventario();


                        ?>

                     </div>
                   </div>
                   
                 </div>
               </div>
             </div>
             <div class="box-body">
               <!-- FIN DE MODAL -->

               <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

                 <thead>
                   <tr>
                     <th>Codigo </th>
                     <th>Producto</th>
                     <th>Cantidad</th>
                     <th>Sede</th>



                   </tr>



                 </thead>

                 <tbody>

                   <?php


                    $item = null;


                    $valor = null;


                    $inventario = Controladorinventario::ctrMostrarinventario($item, $valor);


                    foreach ($inventario as $key => $value) {

                      echo '

            <tr>

         <td>' . ($key + 1) . '</td>
       
       
         <td>' . $value["descripcion"] . '</td>
         
         <td>' . $value["cantidad"] . '</td>

         <td>' . $value["categorias"] . '</td>';

                      echo '<td>

             <div class="btn-group">



                 </button>


             </div>

         </td>

     </tr> ';
                    }


                    ?>


                 </tbody>

               </table>



         </section>

       </div>