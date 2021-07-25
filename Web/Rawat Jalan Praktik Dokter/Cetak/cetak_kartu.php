<?php
require('fpdf181/fpdf.php');
include 'koneksi/koneksi.php';

$nomer=$_GET['id_pas'];
// $nomer='10';
$query=mysqli_query($koneksi,"SELECT * FROM tb_pasien WHERE no_rm='$nomer' ");
$res=mysqli_fetch_array($query);
//header tabel
$pdf = new FPDF('L','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',9);

$pdf->Rect(5,5,120,80, 'D');
$pdf->Ln();
$pdf->Cell(24,24,"",1,0);
$pdf->Cell(20,8,"No. Rm",0,0);
$pdf->Cell(3,8,":",0,0);
$pdf->Cell(57,8,$res['no_rm'],'B',1);
$pdf->Cell(24);
$pdf->Cell(80,8,"KARTU IDENTITAS BEROBAT",0,1,'C');
$pdf->Cell(24);
$pdf->Cell(80,8,"(KIB)",0,1,'C');

$alamat=$res['alamat_pasien'];
$ala=substr($alamat, 0, 40);
$lamat=substr($alamat, 40, 80);
$tgl=date_create($res['tgl_lahir_pasien']);
$lahir= date_format($tgl,'d F Y');

$pdf->Cell(32,8,"NAMA",0,0);
$pdf->Cell(3,8,":",0,0);
$pdf->Cell(69,8,$res['nama_pasien'],'B',1);
$pdf->Cell(32,8,"TANGGAL LAHIR",0,0);
$pdf->Cell(3,8,":",0,0);
$pdf->Cell(69,8,$lahir,'B',0);
$pdf->Cell(9,8,$res['jenis_kelamin'],0,1);
$pdf->Cell(32,8,"ALAMAT",0,0);
$pdf->Cell(3,8,":",0,0);
$pdf->Cell(69,8,$ala,'B',1);
$pdf->Cell(35);
$pdf->Cell(69,8,$lamat,'B',1);
$pdf->Cell(32,8,"NAMA KELUARGA",0,0);
$pdf->Cell(3,8,":",0,0);
$pdf->Cell(69,8,$res['nama_keluarga'],'B',1);
$pdf->Cell(110,2,'',0,1);
$pdf->Cell(110,8,"Kartu Ini Harus Dibawa Setiap Kali Berobat",0,1, 'C');
$pdf->Output('I','kartu_berobat_'.$res['nama_pasien'].'.pdf');
?>