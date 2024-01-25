<?php

require_once "../../controladores/ventas.controlador.php";
require_once "../../modelo/ventas.modelo.php";

require_once "../../controladores/clientes.controlador.php";
require_once "../../modelo/clientes.modelo.php";

require_once "../../controladores/usuarios.controlador.php";
require_once "../../modelo/usuarios.modelo.php";

require_once "../../controladores/productos.controlador.php";
require_once "../../modelo/productos.modelo.php";

require_once "../../controladores/inventario.controlador.php";
require_once "../../modelo/inventario.modelo.php";

require_once "../../controladores/pagos.controlador.php";
require_once "../../modelo/pagos.modelo.php";


class  imprimirCliente{


public $id;



public function traerImpresionCliente(){


//TRAEMOS LA INFORMACIÓN DEL CLIENTE

$itemCliente = "id";
$valorCliente = $this->codigo;

$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

$itemPago = "cliente";
$valorPago = $this->codigo;

$respuestaPago = ControladorPagos::ctrMostrarPagos($itemPago,$valorPago);


// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set margins
$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------
// set default font subsetting mode
$pdf->setFontSubsetting(true);
// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->setFont('dejavusans', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));




// Set some content to print
$bloque1 = <<<EOD


	<table>
		
		<tr>
		
		<table style=" margin-top: 5px;">
		<tr>
			<td style="font-size: 16px; font-weight: bold; text-align: center;">Reporte General de Pagos</td>
			<td style="font-size: 16px; font-weight: bold; text-align: center;">Código: $respuestaCliente[id]</td>
		</tr>
		</table>

			<td style="background-color:white; width:110px; text-align:center; color:red"><br><br></td>
			
		</tr>

	</table>


EOD;



// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $bloque1, 0, 1, 0, true, '', true);


// Set some content to print
$bloque2 = <<<EOD


	<table>
		
		<tr>
			
			<td style="width:540px"><img src="images/back.jpg"></td>
		
		</tr>

	</table>
	

	<table style="font-size:10px; padding:5px 10px;">
	
		<tr>

		
			<td style="border: 1px solid #666; background-color:white; width:390px">

				Cliente: $respuestaCliente[nombre]

			</td>

			<td style="border: 1px solid #666; background-color:white; width:221px; text-align:left">
			
				DNI: $respuestaCliente[documento]

			</td>

		</tr>

		<tr>
		
		<td style="border-bottom: 1px solid #666; background-color:white; width:540px"></td>

		</tr>

	</table>




EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $bloque2, 0, 1, 0, true, '', true);


$bloque3 = <<<EOF

		<table style="font-size:10px; padding:5px 10px; width: 540px;">
		<tr>
			<td style="border: 1px solid #666; background-color:white; width: 160px; text-align:center">S/Pago</td>
			<td style="border: 1px solid #666; background-color:white; width: 250px; text-align:center">DETALLE</td>
			<td style="border: 1px solid #666; background-color:white; width: 100px; text-align:center">FECHA</td>
			<td style="border: 1px solid #666; background-color:white; width: 100px; text-align:center">CAJA</td>
		</tr>
		</table>

EOF;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $bloque3, 0, 1, 0, true, '', true);


$bloque5 = <<<EOF
    <table style="font-size:10px; padding:5px 10px;">
EOF;

foreach ($respuestaPago as $registro) {
    $bloque5 .= '<tr>';
    $bloque5 .= '<td style="border: 1px solid #666; background-color:white; width: 160px; text-align:center">' . htmlspecialchars($registro['monto']) . '</td>';
    $bloque5 .= '<td style="border: 1px solid #666; background-color:white; width: 250px; text-align:center">' . htmlspecialchars($registro['Detalle']) . '</td>';
    $bloque5 .= '<td style="border: 1px solid #666; background-color:white; width: 100px; text-align:center">' . htmlspecialchars($registro['fechahora']) . '</td>';
	$bloque5 .= '<td style="border: 1px solid #666; background-color:white; width: 100px; text-align:center">Administrador</td>';
    $bloque5 .= '</tr>';
}

$bloque5 .= <<<EOF
    </table>
EOF;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $bloque5, 0, 1, 0, true, '', true);








$pdf->Output('factura.pdf', 'I');


		}





}


$factura = new imprimirCliente();
$factura -> codigo = $_GET["codigo"];
$factura -> traerImpresionCliente();