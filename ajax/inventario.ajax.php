<?php

require_once "../controladores/inventario.controlador.php";
require_once "../modelo/inventario.modelo.php";



class Ajaxinventario{


    public $idCategoria;

    public function ajaxCrearCodigoinventario(){

        $item="id_categoria";
        $valor=$this->idCategoria;
        $orden="id";

        $respuesta=Controladorinventarios::ctrMostrarInventario($item,$valor,$orden);

        echo json_encode($respuesta);
        var_dump("valor de  valor".$valor);

    }




}


/*=============================================
GENERAR CÓDIGO A PARTIR DE ID CATEGORIA
=============================================*/	

if(isset($_POST["idCategoria"])){

$codigoInventario=new AjaxInventario();
$codigoInventario->idCategoria =$_POST["idCategoria"];
$codigoInventario->ajaxCrearCodigoInventario();

}

/*=============================================
GENERAR CÓDIGO A PARTIR DE ID CATEGORIA
=============================================*/	

if(isset($_POST["traerInventario"])){

$traerInventario=new AjaxInventarios();
$traerInventario->traerInventario =$_POST["traerInventario"];
$traerInventario->ajaxEditarInventario();

}


/*=============================================
TRAER Inventario
=============================================*/	

if(isset($_POST["nombreInventario"])){

$traerInventario=new AjaxInventarios();
$traerInventario->nombreInventario =$_POST["nombreInventario"];
$traerInventario->ajaxEditarInventario();

}




?>