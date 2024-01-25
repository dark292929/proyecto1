<?php 

class Controladorinventario{


    static public function ctrMostrarinventario($item,$valor){

        $tabla="inventario";

        $respuesta=Modeloinventario::mdlMostrarinventario($tabla,$item,$valor);

        return $respuesta;

    }


    static public function ctrCrearinventario(){

        if(isset($_POST["nuevacantidad"])){

            $tabla = "inventario";
            $datos = $_POST["nuevacantidad"];
    
            foreach ($datos as $idProducto => $cantidad) {
                $respuesta = Modeloinventario::mdlIngresarinventario($tabla, $idProducto, $cantidad);
    
                if($respuesta !== "ok"){

                echo "<script>

                        Swal.fire({
                        title: '¡la inventario ha sido guardada correctamente!',
                        icon: 'success',
                        }).then((result) => {
                                                 
                            window.location = 'inventario';
                                                  
                        })
                                            
                    </script>";



            }



        }
     
    }

}


    static public function ctrEditarinventario(){

        if(isset($_POST["editarinventario"])){


            $tabla = "inventario";

            $datos=array("inventario"=>$_POST["editarinventario"],
            "id"=>$_POST["idinventario"]);

            $respuesta=Modeloinventario::mdlEditarinventario($tabla,$datos);

            if($respuesta=="ok"){

                  echo "<script>

                        Swal.fire({
                        title: '¡la inventario ha sido editada correctamente!',
                        icon: 'success',
                        }).then((result) => {
                                                 
                            window.location = 'inventario';
                                                  
                        })
                                            
                    </script>";




            }


         





        }





    }




    static public function ctrBorrarinventario(){

        if(isset($_GET["idinventario"])){


            $tabla ="inventario";
			$datos = $_GET["idinventario"];

            $respuesta=Modeloinventario::mdlBorrarinventario($tabla,$datos);

            	if($respuesta == "ok"){

				echo'<script>

					Swal.fire({
						  type: "success",
						  title: "La categoría ha sido borrada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "inventario";

									}
								})

					</script>';
			}




        }




    }





}



?>