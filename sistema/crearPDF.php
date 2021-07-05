<?php
session_start();

include_once 'conexion.php';

require('fpdf/fpdf.php');

$id_user = $_SESSION['id_alumnos'];

$becado = "SELECT * FROM alumnos WHERE id_alumnos = $id_user";

$becas = mysqli_query($conn, $becado);

$row2 = mysqli_fetch_assoc($becas);

$sql = "SELECT costo FROM colegiatura";
$resultado = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($resultado);


$descuento=$row2['beca']*$row['costo'];
$total=$row['costo']-$descuento;
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Pago de colegiatura realiado',0,1);
$pdf->Cell(40,10,'Matricula: '.$row2['matricula'],0,1);
$pdf->Cell(40,10,'Nombre: '.$row2['nombre'],0,1);
$pdf->Cell(40,10,'Subtotal: $'.$row['costo'],0,1);
$pdf->Cell(40,10,'Descuento: $'.$descuento,0,1);
$pdf->Cell(40,10,'Total: $'.$total,0,1);
$pdf->Cell(40,10,'Fecha: '.date('d-m-y'),0,1);
$pdf->Output();
?>