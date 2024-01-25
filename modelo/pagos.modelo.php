<?php 

require_once "conexion.php";


class ModeloPagos{

    static public function mdlMostrarPagos($tabla,$item,$valor){


        if($item !=null){

            $stmt=Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item=:$item");

            $stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();



        }else{

            $stmt=Conexion::conectar()->prepare("SELECT * FROM $tabla");

            $stmt->execute();

            return $stmt->fetchAll();

        }



        $stmt->close();
        $stmt=null;

    }

 
                        
    static public function mdlIngresarPagos($tabla,$datos){

        $stmtCliente = Conexion::conectar()->prepare("SELECT monto_actual, suma_pagos FROM clientes WHERE id = :idcliente");
        $stmtCliente->bindParam(":idcliente", $datos["idcliente"], PDO::PARAM_INT);
        $stmtCliente->execute();
        $cliente = $stmtCliente->fetch(PDO::FETCH_ASSOC);

        // Suma el nuevo monto al monto actual y suma_pagos
        $nuevoMontoActual = $cliente['monto_actual'] + $datos["ingresarmonto"];
        $nuevaSumaPagos = $cliente['suma_pagos'] + $datos["ingresarmonto"];

        // Actualiza el monto actual y suma_pagos en la tabla cliente
        $stmtActualizar = Conexion::conectar()->prepare("UPDATE clientes SET monto_actual = :nuevoMontoActual, suma_pagos = :nuevaSumaPagos WHERE id = :idcliente");
        $stmtActualizar->bindParam(":nuevoMontoActual", $nuevoMontoActual, PDO::PARAM_STR);
        $stmtActualizar->bindParam(":nuevaSumaPagos", $nuevaSumaPagos, PDO::PARAM_STR);
        $stmtActualizar->bindParam(":idcliente", $datos["idcliente"], PDO::PARAM_INT);
        $stmtActualizar->execute();

        // Inserta el nuevo pago en la tabla pagos
        $stmt=Conexion::conectar()->prepare("INSERT INTO $tabla(monto,Detalle,fechahora,cliente) VALUES (:ingresarmonto,:ingresar_detalle,:ingresar_fechaHoraPago,:idcliente)");

        $stmt->bindParam(":ingresarmonto",$datos["ingresarmonto"] ,PDO::PARAM_STR);
        $stmt->bindParam(":ingresar_detalle",$datos["ingresar_detalle"] ,PDO::PARAM_STR);
        $stmt->bindParam(":ingresar_fechaHoraPago",$datos["ingresar_fechaHoraPago"] ,PDO::PARAM_STR);
        $stmt->bindParam(":idcliente",$datos["idcliente"] ,PDO::PARAM_STR);


        if($stmt->execute()){

            return "ok";


        }else{

            return "error";
        }
         $stmt->close();
        $stmt=null;


    }



	static public function mdlEditarPagos($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, documento = :documento, email = :email, telefono = :telefono, direccion = :direccion WHERE id = :id");

        $nombre = $datos["nombre"];

		var_dump('nombre:', $nombre);


		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_INT);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}



    static public function mdlEliminarPagos($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id=:id");

        $stmt->bindParam(":id", $datos, PDO::PARAM_INT);

        if($stmt->execute()){

            return "ok";
        }else{

            return "error";
        }

        	$stmt->close();
		$stmt = null;






    }

	/*=============================================
	ACTUALIZAR PAGOS
	=============================================*/

    static public function mdlActualizarPagos($tabla, $item1, $valor1, $valor){

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id = :id");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":id", $valor, PDO::PARAM_STR);

        if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;




    }


}


?>