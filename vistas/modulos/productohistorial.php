<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Historial de Productos
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> inicio</a></li>
            <li class="active">Administrar productos por Almacén</li>
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
                                   <th>Descripción</th>
                                   <th>Stock</th>
                                   <th>Precio de compra</th>
                                   <th>Precio de venta</th>
                                   <th>fecha</th>


                               </tr>

                           </thead>

                           <tbody>

                               <?php 

                            $item=null;
                            
                            
                            $valor=null;

                            $orden="id";


                            $Productos=ControladorProductos::ctrMostrarProductos($item,$valor, $orden);


                            foreach ($Productos as $key => $value) {

                                $item="id";
                                $valor=$value["categoria"];

                                $categoria=ControladorCategorias::ctrMostrarCategorias($item,$valor);

                                echo '

                                   <tr>

                                <td>'.($key+1).'</td>  
                                <td>'.$value["descripcion"].'</td>
                                <td>'.$value["stock"].'</td>
                                <td>'.$value["precio_compra"].'</td>
                                <td>'.$value["precio_venta"].'</td>     
                                <td>'.$value["fecha"].'</td>                                                                                                     
                                ';

                            
                                echo '<td>



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

