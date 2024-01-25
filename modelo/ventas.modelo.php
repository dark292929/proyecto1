<?php 

require_once "conexion.php";

class ModeloVentas{


    static public function mdlMostrarVentas($tabla,$item,$valor){

        if($item !=null){

            $stmt=Conexion::conectar()->prepare("SELECT * FROM $tabla  WHERE $item=:$item ORDER BY id ASC");

            $stmt ->bindParam(":".$item ,$valor,PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();



        }else{

            $stmt=Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");

            $stmt->execute();

            return $stmt->fetchAll();

        }

        $stmt->close();
        $stmt=null;

    }




    static public function mdlEditarVenta($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET  id_cliente = :id_cliente, id_vendedor = :id_vendedor, productos = :productos, impuesto = :impuesto, neto = :neto, total= :total, metodo_pago = :metodo_pago WHERE codigo = :codigo");


        $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":id_vendedor", $datos["id_vendedor"], PDO::PARAM_INT);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
		$stmt->bindParam(":neto", $datos["neto"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":metodo_pago", $datos["metodo_pago"], PDO::PARAM_STR);

        if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;




    }



	static public function mdlIngresarVenta($tabla, $datos) {
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo, id_cliente, id_vendedor, impuesto, neto, total, metodo_pago, productos) VALUES (:codigo, :id_cliente, :id_vendedor, :impuesto, :neto, :total, :metodo_pago, :producto)");
	
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":id_vendedor", $datos["id_vendedor"], PDO::PARAM_INT);
		$stmt->bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
		$stmt->bindParam(":neto", $datos["neto"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":metodo_pago", $datos["metodo_pago"], PDO::PARAM_STR);
	
		$productos_array = json_decode($datos["productos"], true);
	
		if (count($productos_array) === 1) {
			// Si solo hay un producto, inserta directamente sin bucle
			$producto_id = $productos_array[0]["id"];
			$stmt->bindParam(":producto", $producto_id, PDO::PARAM_INT);
			$stmt->execute();
		} else {
			// Si hay más de un producto, usa el bucle para insertar todos
			foreach ($productos_array as $producto) {
				$producto_id = $producto["id"];
				$stmt->bindParam(":producto", $producto_id, PDO::PARAM_INT);
				$stmt->execute();
			}
		}
	
		if ($stmt->rowCount() > 0) {
			return "ok";
		} else {
			return "error";
		}
	
		$stmt->close();
		$stmt = null;
	}


    static public function mdlEliminarVenta($tabla ,$datos){

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;





    }





	/*=============================================
	RANGO FECHAS
	=============================================*/	

static public function mdlRangoFechasVentas($tabla,$fechaInicial,$fechaFinal){



	if($fechaInicial == null){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");

		$stmt -> execute();

		return $stmt -> fetchAll();	



	}else if($fechaInicial ==$fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha like '%$fechaFinal%'");

			$stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();



	}else{


		$fechaFinal=explode("-",$fechaFinal);

		//var_dump($fechaFinal);

		$fechaFinal =$fechaFinal[0].'-'.$fechaFinal[1].'-'.($fechaFinal[2]+1);

		if($fechaInicial != $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' and '$fechaFinal' ");




		}

		$stmt -> execute();

		return $stmt -> fetchAll();



	}





}





static public function mdlSumaTotalVentas($tabla){

	$stmt = Conexion::conectar()->prepare("SELECT SUM(neto) as total FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

}










    

}



?>