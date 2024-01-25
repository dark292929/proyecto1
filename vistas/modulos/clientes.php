<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Administrar clientes
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> inicio</a></li>
            <li class="active">Administrar clientes</li>
        </ol>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCliente">
                    Agregar Cliente
                </button>
            </div>
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
                                   <th>nombre</th>
                                   <th>DNI</th>
                                   <th>total de compras</th>
                                   <th>Pago Total</th>
                                   <th>Saldo</th>
                                   <th>Acciones</th>
                               </tr>
                           </thead>
                           <tbody>

                               <?php 

                            $item=null;
                            
                            
                            $valor=null;


                            $Clientes=ControladorClientes::ctrMostrarClientes($item,$valor);


                            foreach ($Clientes as $key => $value) {

                            

                                echo '

                                   <tr>

                                <td>'.($key+1).'</td>                            
                                <td>'.$value["nombre"].'</td>
                                <td>'.$value["documento"].'</td>                                                                                                         
                                <td>'.$value["compras"].'</td>
                                <td>'.$value["suma_pagos"].'</td>
                                <td>'.$value["monto_actual"].'</td>';

                                echo '<td>

                                    <div class="btn-group">

                                        <button class="btn btn-warning btnEditarCliente" idCliente="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarCliente">

                                            <i class="fa fa-pencil"></i>
                                        </button>


                                        <button class="btn btn-info btnImprimirVendedor" idCliente="'.$value["id"].'" idCliente="'.$value["id"].'">

                                            <i class="fa fa-print"></i>
                                        </button>

                                        <button class="btn btn-success btnpagosclientes" data-toggle="modal" data-target="#modalPagosClientes" data-idcliente="'.$value["id"].'">
                                             <i class="fa fa-money"></i>
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

<!-- Ingresar Pago -->
       <div class="modal fade" id="modalPagosClientes" tabindex="-1" role="dialog" aria-labelledby="modalPagosClientesLabel" aria-hidden="true">
            <div class="modal-dialog">
        <div class="modal-content my-custom-font-style">

            <!-- Cabecera del modal -->
            <div class="modal-header" style="background:#3c8dbc; color:white">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Ingresar Datos de Pago</h4>
            </div>
            <!-- Cuerpo del modal -->
            <div class="modal-body">
                <!-- Formulario para ingresar los datos -->
                <form role="form" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-money"></i></span>
                            <input type="text" class="form-control input-lg" id="ingresarmonto" name="ingresarmonto" placeholder="Ingrese el monto">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-comment"></i></span>
                            <input type="text" class="form-control input-lg" id="ingresar_detalle" name="ingresar_detalle"placeholder="Ingrese el detalle">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="datetime-local" class="form-control input-lg" id="ingresar_fechaHoraPago" name="ingresar_fechaHoraPago">
                        </div>
                    </div>
                    <input type="hidden" name="idcliente" id="idcliente" value="">


                                <!-- Pie del modal -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar Pago</button>
            </div>

            <?php 

$crearPago=new ControladorPagos();
$crearPago->ctrCrearPago();

?>
   <script>
$(".btnpagosclientes").on("click", function() {
    var idCliente = $(this).data("idcliente");
    console.log("ID del cliente para pagos: " + idCliente);
    $("#idcliente").val(idCliente); // Asignar el valor del ID del cliente al campo oculto
});
</script>
   
                </form>
            </div>



        </div>
    </div>
</div>

<!-- FIN PAGO -->



<!--=====================================
MODAL AGREGAR ClienteS
======================================-->
       <div id="modalAgregarCliente" class="modal fade" role="dialog">

           <div class="modal-dialog">

               <div class="modal-content">


                   <form role="form" method="post" enctype="multipart/form-data">

                       <!--=====================================
                    CABEZA DEL MODAL
                    ======================================-->


                       <div class="modal-header" style="background:#3c8dbc; color:white">

                           <button type="button" class="close" data-dismiss="modal">&times;</button>

                           <h4 class="modal-title">Agregar Cliente</h4>

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

                                       <input type="text" class="form-control input-lg" name="nuevoCliente"
                                           placeholder="Ingresar nombre" required>

                                   </div>

                               </div>

                               <!-- ENTRADA PARA EL DOCUMENTO ID -->

                               <div class="form-group">

                                   <div class="input-group">

                                       <span class="input-group-addon"><i class="fa fa-key"></i></span>

                                       <input type="text" min="0" class="form-control input-lg" name="nuevoDocumentoId"
                                           placeholder="Ingresar documento" required>

                                   </div>

                               </div>

                               <!-- ENTRADA PARA EL EMAIL -->

                               <div class="form-group">

                                   <div class="input-group">

                                       <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                                       <input type="email" class="form-control input-lg" name="nuevoEmail"
                                           placeholder="Ingresar email" required>

                                   </div>

                               </div>


                               <!-- ENTRADA PARA EL TELÉFONO -->

                               <div class="form-group">

                                   <div class="input-group">

                                       <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                                       <input type="text" class="form-control input-lg" name="nuevoTelefono"
                                           placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999-9999'"
                                           data-mask required>

                                   </div>

                               </div>


                               <!-- ENTRADA PARA LA DIRECCIÓN -->

                               <div class="form-group">

                                   <div class="input-group">

                                       <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>

                                       <input type="text" class="form-control input-lg" name="nuevaDireccion"
                                           placeholder="Ingresar dirección" required>

                                   </div>

                               </div>

                               <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->



                           </div>

                       </div>

                       <!--=====================================
                    PIE DEL MODAL
                    ======================================-->

                       <div class="modal-footer">

                           <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                           <button type="submit" class="btn btn-primary">Guardar Cliente</button>

                       </div>

                       <?php 

                    $crearCliente=new ControladorClientes();
                    $crearCliente->ctrCrearCliente();
                    
                    
                    
                    ?>


                   </form>

               </div>
           </div>
       </div>










       <!--=====================================
MODAL EDITAR ClienteS
======================================-->
       <div id="modalEditarCliente" class="modal fade" role="dialog">

           <div class="modal-dialog">

               <div class="modal-content">

                   <form role="form" method="post">

                       <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

                       <div class="modal-header" style="background:#3c8dbc; color:white">

                           <button type="button" class="close" data-dismiss="modal">&times;</button>

                           <h4 class="modal-title">Editar cliente</h4>

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

                                       <input type="text" class="form-control input-lg" name="editarCliente"
                                           id="editarCliente" required>
                                       <input type="hidden" id="idCliente" name="idCliente">
                                   </div>

                               </div>

                               <!-- ENTRADA PARA EL DOCUMENTO ID -->

                               <div class="form-group">

                                   <div class="input-group">

                                       <span class="input-group-addon"><i class="fa fa-key"></i></span>

                                       <input type="number" min="0" class="form-control input-lg"
                                           name="editarDocumentoId" id="editarDocumentoId" required>

                                   </div>

                               </div>

                               <!-- ENTRADA PARA EL EMAIL -->

                               <div class="form-group">

                                   <div class="input-group">

                                       <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                                       <input type="email" class="form-control input-lg" name="editarEmail"
                                           id="editarEmail" required>

                                   </div>

                               </div>

                               <!-- ENTRADA PARA EL TELÉFONO -->

                               <div class="form-group">

                                   <div class="input-group">

                                       <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                                       <input type="text" class="form-control input-lg" name="editarTelefono"
                                           id="editarTelefono" data-inputmask="'mask':'(999) 999-9999'" data-mask
                                           required>

                                   </div>

                               </div>

                               <!-- ENTRADA PARA LA DIRECCIÓN -->

                               <div class="form-group">

                                   <div class="input-group">

                                       <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>

                                       <input type="text" class="form-control input-lg" name="editarDireccion"
                                           id="editarDireccion" required>

                                   </div>

                               </div>

                               <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->

                           </div>

                       </div>

                       <!--=====================================
        PIE DEL MODAL
        ======================================-->

                       <div class="modal-footer">

                           <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                           <button type="submit" class="btn btn-primary">Guardar cambios</button>

                       </div>

                   </form>

                   <?php

        $editarCliente = new ControladorClientes();
        $editarCliente -> ctrEditarCliente();

      ?>



               </div>

           </div>

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

            /*=============================================
                IMPRIMIR CLIENTE
                =============================================*/


                $(".tablas").on("click", ".btnImprimirVendedor", function(){


                var idCliente = $(this).attr("idCliente");

                window.open("extensiones/examples/clientes.php?codigo="+idCliente, "_blank");


                })


        </script>
        

       <?php 


$borraCliente=new ControladorClientes();
$borraCliente-> ctrEliminarCliente();
   
   
   ?>


