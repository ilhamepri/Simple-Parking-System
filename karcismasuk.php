<?php
$nostnk=$_REQUEST['nostnk'];
$noarea=$_REQUEST['noarea'];
$namakend=$_REQUEST['namakend'];
$idkarcis=$_REQUEST['idkarcis'];
$user=$_REQUEST['user'];
$masuk=$_REQUEST['masuk'];
require('assets/fpdf/fpdf.php');


$pdf = new FPDF('P','mm',array(140,100));
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(30,10,'X PLAZA SURABAYA ');
$pdf->Ln();
$pdf->SetFont('Arial','',10);
$pdf->Cell(30,10,$nostnk);
$pdf->Cell(10,10,' / ');
$pdf->Cell(30,10,$namakend);
$pdf->Ln();
$pdf->Cell(30,10,$idkarcis);
$pdf->Cell(10,10,' / ');
$pdf->Cell(30,10,$user);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(30,10,'In     :');
$pdf->Cell(30,10,$masuk);
$pdf->Ln();
$pdf->Cell(30,10,'Area   :');
$pdf->Cell(30,10,$noarea);
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial','',10);
$pdf->Cell(30,10,'SELAMAT DATANG DI');
$pdf->Ln();
$pdf->Cell(30,10,'X PLAZA SURABAYA');
$pdf->Ln();
$pdf->Cell(30,10,'SIMPAN TIKET INI DENGAN AMAN');
$pdf->Ln();
$pdf->Output();
?>
