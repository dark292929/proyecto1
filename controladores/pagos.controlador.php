<?php 

class ControladorPagos{

    static public function ctrCrearPago(){

        if(isset($_POST["ingresarmonto"])){
			


            $tabla="pagos";

            $datos= array("ingresarmonto" =>$_POST["ingresarmonto"],
                        "ingresar_detalle" =>$_POST["ingresar_detalle"],
                        "ingresar_fechaHoraPago" =>$_POST["ingresar_fechaHoraPago"],
						"idcliente" =>$_POST["idcliente"]
                         );
                        
                        $respuesta=ModeloPagos::mdlIngresarPagos($tabla,$datos);

                          	if($respuesta == "ok"){

                                echo'<script>

                                Swal.fire({
                                    type: "success",
                                    title: "El Pago ha sido guardado correctamente",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"
                                    }).then(function(result){
                                                if (result.value) {

                                                window.location = "clientes";

                                                }
                                            })

                                </script>';

				}
       




        }




        
    }






    static public function ctrMostrarPagos($item,$valor){

        $tabla="pagos";


        $respuesta=ModeloPagos::mdlMostrarPagos($tabla,$item,$valor);


        return $respuesta;
    
    }



// NO HAY FUNCION PARA EDITAR PAGOS NI ELIMINAR
    	/*=============================================
	EDITAR PAGOS
	=============================================*/

    static public function ctrEditarPagos(){


       if(isset($_POST["editarPagos"])){

           	$tabla = "pagos";

			   	$datos = array("id"=>$_POST["idCliente"],
			   				   "nombre"=>$_POST["editarCliente"],
					           "documento"=>$_POST["editarDocumentoId"],
					           "email"=>$_POST["editarEmail"],
					           "telefono"=>$_POST["editarTelefono"],
					           "direccion"=>$_POST["editarDireccion"],
					           "fecha_nacimiento"=>$_POST["editarFechaNacimiento"]);

			   	$respuesta = ModeloPagoss::mdlEditarPagos($tabla, $datos);

                 

            

			   	if($respuesta == "ok"){

					echo'<script>

					Swal.fire({
						  type: "success",
						  title: "El Pago ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "Pagos";

									}
								})

					</script>';

				}




        }





    }


	/*=============================================
	ELIMINAR Pagos
	=============================================*/

    static public function ctrEliminarPagos(){


        if(isset($_GET["idCliente"])){

            $tabla="Pagos";
            $datos=$_GET["idCliente"];

            	$respuesta = ModeloPagos::mdlEliminarPagos($tabla, $datos);

                	if($respuesta == "ok"){

				echo'<script>

				Swal.fire({
					  type: "success",
					  title: "El Pago ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "Pagos";

								}
							})

				</script>';

			}






        }




    }






}




?>