<?php

class ControladorUsuarios{

    	/*=============================================
	INGRESO DE USUARIO
	=============================================*/

    static public function ctrIngresoUsuario(){


        if(isset($_POST["usuario"])){

            $encriptar=crypt($_POST["password"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

            $tabla="usuarios";

            $item="usuario";

            $valor=$_POST["usuario"];


            $respuesta=ModeloUsuarios::mdlMostrarUsuarios($tabla,$item,$valor);

            if($respuesta["usuario"] == $_POST["usuario"] && $respuesta["password"] == $encriptar){


                if($respuesta["estado"]==1){

                    $_SESSION["iniciarSesion"]="ok";
                    $_SESSION["id"]= $respuesta["id"];
                    $_SESSION["nombre"]= $respuesta["nombre"];
                    $_SESSION["usuario"]= $respuesta["usuario"];
                    $_SESSION["perfil"]= $respuesta["perfil"];
                    $_SESSION["rol"]= $respuesta["rol"];
                     $_SESSION["categoriasede"]= $respuesta["categoria"];

                    echo '<script>

                    window.location="usuarios";
                    
                    
                    </script>';


                }else{

                    echo '<br>
                       <div class="alert alert-danger">El usuario aún no está activado</div> ';
                              

                }



            }else{

                echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';


            }



        }



    }





     /*=============================================
	MOSTRAR USUARIOS
	=============================================*/

    static public function ctrMostrarUsuarios($item,$valor){

        $tabla="usuarios";

        $respuesta=ModeloUsuarios::mdlMostrarUsuarios($tabla,$item,$valor);

        return $respuesta;

    }


    	/*=============================================
	EDITAR USUARIO
	=============================================*/

    static public function ctrEditarUsuario(){

            if(isset($_POST["editarNombre"])){

                $tabla = "usuarios";


                if($_POST["editarPassword"] != ""){


                    $encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');


                }else{

                    $encriptar = $_POST["passwordActual"];

                
                }


                	$datos = array("nombre" => $_POST["editarNombre"],
							   "usuario" => $_POST["editarUsuario"],
							   "password" => $encriptar,
							   "perfil" => $_POST["editarPerfil"]
							   );


                    $respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);

                    
				if($respuesta == "ok"){

                      echo "<script>

                        Swal.fire({
                        title: 'El usuario ha sido editado correctamente',
                        icon: 'success',
                        }).then((result) => {
                                                 
                            window.location = 'usuarios';
                                                  
                        })
                                            
                    </script>";

				

				}



            }




    }













    /*=============================================
	REGISTRO DE USUARIO
	=============================================*/

    static public function ctrCrearUsuario(){


        if(isset($_POST["nuevoNombre"])){



         

                    $tabla="usuarios";


                    $encriptar=crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                    $datos=array(

                        "nombre"=>$_POST["nuevoNombre"],
                        "usuario"=>$_POST["nuevoUsuario"],
                        "password"=>$encriptar,
                        "perfil"=>$_POST["nuevoPerfil"]
                        );



                        $respuesta=ModeloUsuarios::mdlIngresarUsuario($tabla,$datos);


                        if($respuesta=="ok"){

                               echo "<script>

                                Swal.fire({
                                        title: 'se guardo correctamente el usuario',
                                        icon: 'success',
                                        }).then((result) => {
                                                                
                                            window.location = 'usuarios';
                                                                
                                        })
                                                
                                </script>";






                        }
                        
                 
                        




                        
                        
                        
                        {


                    }


        }







    }



     /*=============================================
	BORRAR USUARIO
	=============================================*/


    static public function ctrBorrarUsuario(){


        if(isset($_GET["idUsuario"])){

            $tabla="usuarios";
            $datos=$_GET["idUsuario"];

            if($_GET["fotoUsuario"]  !=""){

                unlink($_GET["fotoUsuario"]);
                rmdir("vistas/img/usuarios/".$_GET["usuario"]);
  }


  $respuesta=ModeloUsuarios::mdlBorrarUsuarios($tabla,$datos);

  	if($respuesta == "ok"){

                  echo "<script>

                        Swal.fire({
                        title: '¡El usuario ha sido borrado correctamente!',
                        icon: 'success',
                        }).then((result) => {
                                                 
                            window.location = 'usuarios';
                                                  
                        })
                                            
                    </script>";

			

			}





          







        }




    }







}




?>