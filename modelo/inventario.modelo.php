<?php 

require_once "conexion.php";



class Modeloinventario{

/*=============================================
	MOSTRAR inventario
	=============================================*/

    static public function mdlMostrarinventario($tabla,$item,$valor){

         if($item !=null){

          $stmt = Conexion::conectar()->prepare("SELECT inventario.id, productos.descripcion, productos.stock, categorias.categorias, inventario.cantidad FROM $tabla INNER JOIN productos ON inventario.id_producto = productos.id INNER JOIN categorias ON inventario.id_categoria = categorias.id WHERE $item=:$item");

            $stmt->bindParam(":".$item ,$valor,PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();

        }else{

        $stmt = Conexion::conectar()->prepare("SELECT inventario.id, productos.descripcion, productos.stock, inventario.cantidad,categorias.categorias FROM $tabla INNER JOIN productos ON inventario.id_producto = productos.id INNER JOIN categorias ON inventario.id_categoria = categorias.id");

        $stmt->execute();

        return $stmt->fetchAll();

        }


      $stmt->close();
        $stmt=null;
  }



  /*=============================================
	CREAR inventario
	=============================================*/

  static public function mdlIngresarinventario($tabla,$datos){

    $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(cantidad) VALUES(:cantidad)");

    $stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);



     if($stmt->execute()){

        return "ok";

     }else{

         return "error";

     }

    $stmt->close();
    $stmt=null;



  }
   
  
}





?>