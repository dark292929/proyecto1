<?php 


class ControladorProductos{


    static public function ctrEliminarProducto(){


        if(isset($_GET["idProducto"])){

            $tabla="productos";
            $datos=$_GET["idProducto"];

            if($_GET["imagen"] !="" && $_GET["imagen"] != "vistas/img/productos/default/anonymous.png"){

                unlink($_GET["imagen"]);
                rmdir("vistas/img/productos/".$_GET["codigo"]);



            }


            $respuesta=ModeloProductos::mdlEliminarProducto($tabla,$datos);

            	if($respuesta == "ok"){

				echo'<script>

				Swal.fire({
					  type: "success",
					  title: "El producto ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "productos";

								}
							})

				</script>';

			}	




        }




    }






    /*=============================================
	MOSTRAR PRODUCTO
	=============================================*/

    static public function ctrMostrarProductos($item,$valor,$orden){

        $tabla = "productos";

        $orden="ventas";

        $respuesta=ModeloProductos::mdlMostrarProductos($tabla,$item,$valor,$orden);

        return $respuesta;


    }

    /*=============================================
	CREAR PRODUCTO
	=============================================*/

    static public function ctrCrearProducto(){


        if(isset($_POST["nuevaCategoria"])){

            	/*=============================================
				VALIDAR IMAGEN
				=============================================*/

                $ruta="vistas/img/productos/default/anonymous.png";


                if(isset($_FILES["nuevaImagen"]["tmp_name"])){

                    list($ancho, $alto) = getimagesize($_FILES["nuevaImagen"]["tmp_name"]);


                    $nuevoAncho = 500;
					$nuevoAlto = 500;

                    /*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL PRODUCTO
					=============================================*/

                    $directorio="vistas/img/productos/".$_POST["nuevoCodigo"];

                    mkdir($directorio ,0755);

                    /*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

                    if($_FILES["nuevaImagen"]["type"] == "image/jpeg"){


                        $aleatorio = mt_rand(100,999);

                        $ruta = "vistas/img/productos/".$_POST["nuevoCodigo"]."/".$aleatorio.".jpg";

                        $origen = imagecreatefromjpeg($_FILES["nuevaImagen"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);
                    }

                    	if($_FILES["nuevaImagen"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/productos/".$_POST["nuevoCodigo"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["nuevaImagen"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

                }

                	$tabla = "productos";


                    $datos=array("id_categoria"=>$_POST["nuevaCategoria"],
                    "descripcion"=>$_POST["nuevaDescripcion"],
                    "stock"=>$_POST["nuevoStock"],
                    "precio_compra"=>$_POST["nuevoPrecioCompra"],
                    "precio_venta"=>$_POST["nuevoPrecioVenta"]);



                    $respuesta=ModeloProductos::mdlIngresarProducto($tabla,$datos);

                    	if($respuesta == "ok"){

                            echo'<script>

                                Swal.fire({
                                    type: "success",
                                    title: "El producto ha sido guardado correctamente",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"
                                    }).then(function(result){
                                                if (result.value) {

                                                window.location = "productos";

                                                }
                                            })

                                </script>';

				}



      

        }




    }



/*=============================================
	EDITAR PRODUCTO
	=============================================*/

    static public function ctrEditarProducto(){

        if(isset($_POST["editarDescripcion"])){


                $tabla = "productos";

                $datos = array("id_categoria" => $_POST["editarCategoria"],
							   "codigo" => $_POST["editarid"],
							   "descripcion" => $_POST["editarDescripcion"],
							   "stock" => $_POST["editarStock"],
							   "precio_compra" => $_POST["editarPrecioCompra"],
							   "precio_venta" => $_POST["editarPrecioVenta"]);

                               $respuesta=ModeloProductos::mdlEditarProducto($tabla,$datos);

                               	if($respuesta == "ok"){

                                    echo'<script>

                                        Swal.fire({
                                            type: "success",
                                            title: "El producto ha sido editado correctamente",
                                            showConfirmButton: true,
                                            confirmButtonText: "Cerrar"
                                            }).then(function(result){
                                                        if (result.value) {

                                                        window.location = "productos";

                                                        }
                                                    })

                                        </script>';

				                }








        }






    }


		/*=============================================
	MOSTRAR SUMA VENTAS
	=============================================*/

	static public function ctrMostrarSumaVentas(){

		$tabla="productos";

		$respuesta=ModeloProductos::mdlMostrarSumaVentas($tabla);

		return $respuesta;




	}






}


?>