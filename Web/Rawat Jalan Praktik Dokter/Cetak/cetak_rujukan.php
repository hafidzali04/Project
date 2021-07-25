<?php
require('fpdf181/fpdf.php');
include 'koneksi/koneksi.php';

$nama_dokter=$_GET['namdok'];
$tgl=date('d/m/Y');
//header tabel
$pdf = new FPDF('P','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);

$pdf->Rect(5,5,200,120, 'D');
$pdf->Ln();
$pdf->Cell(40,5,$nama_dokter,'B',1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(100,5,"Jl. alamat",0,0);

$pdf->SetFont('Arial','B', 14);
$pdf->Cell(50,5,"Surat Rujukan",0,1,'C');

$pdf->SetFont('Arial','',12);
$pdf->Cell(100,5,"775655",0,0);

$pdf->SetFont('Arial','', 11);
$pdf->Cell(50,5,$tgl,0,1,'C');
$pdf->SetFont('Arial','',12);
$pdf->Cell(190,5,"",'T',1);

$pdf->Cell(20,5,"Yth. TS/ Dr. Jaga",0,1);
$pdf->Cell(20,5,$_POST['rs'],0,1);
$pdf->Cell(20,5,"",0,1);
$pdf->Cell(20,5,"Dengan Hormat",0,1);
$pdf->Cell(20,5,"Mohon konsultasi dan perawatan selanjutnya",0,1);

$pdf->Cell(35,5,"Nama :",0,0,'R');
$pdf->Cell(50,5,$_POST['nama'],0,1,'R');
$pdf->Cell(35,5,"Umur :",0,0,'R');
$pdf->Cell(50,5,$_POST['umur'],0,1,'R');
$pdf->Cell(35,5,"Jenis Kelamin :",0,0,'R');
$pdf->Cell(50,5,$_POST['jk'],0,1,'R');
$pdf->Cell(35,5,"Pekerjaan :",0,0,'R');
$pdf->Cell(50,5,$_POST['pekerjaan'],0,1,'R');
$pdf->Cell(35,5,"Alamat :",0,0,'R');
$pdf->Cell(50,5,$_POST['alm'],0,1,'R');
$pdf->Cell(35,5,"",0,1);

$pdf->Cell(23,5,"Diagnosa :",0,0);
$pdf->Cell(150,5,$_POST['diagnosa'],0,1);
$pdf->Cell(53,5,"Pengobatan Sebelumnya :",0,0);
$pdf->Cell(100,5,$_POST['pengobatan'],0,1);
$pdf->Cell(120,5,"",0,0);
$pdf->Cell(50,5,"Wassalam",0,1,'C');
$pdf->Cell(120,15,"",0,0);
$pdf->Cell(50,15,"",0,1);
$pdf->Cell(120,5,"",0,0);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(50,5,$nama_dokter,'B',1,'C');
$pdf->Output('I','surat_rujukan_'.$_POST['nama'].'.pdf');
?>