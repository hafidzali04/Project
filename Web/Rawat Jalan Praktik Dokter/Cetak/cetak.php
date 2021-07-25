<?php
require('fpdf181/fpdf.php');
include 'koneksi/koneksi.php';

// $no_rm=$_GET['id_per'];
$periksa='19';
$sql=mysqli_query($koneksi,"SELECT * FROM tb_pemeriksaan per, tb_pasien pas WHERE pas.no_rm=per.no_rm AND per.id_periksa='$periksa'");
$data=mysqli_fetch_array($sql);

//header tabel
$pdf = new FPDF('P','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);


$pdf->Cell(40,5,"Praktik Dokter",0,1);
$pdf->SetFont('Arial','',10);
$pdf->Cell(130,5,"dr.ana",0,0);


$pdf->Cell(50,5,"Nama Keluarga",1,1,'C');
$pdf->Cell(130,5,"",0,0);
$pdf->Cell(50,15,$data['nama_keluarga'],1,1,'C');

$pdf->Cell(180,5,"",0,1,'C');

$pdf->Cell(50,5,"Alergi Obat",1,0,'C');
$pdf->Cell(80,5,"",0,0,'C');
$pdf->Cell(50,5,"No. RM",1,1,'C');
$pdf->Cell(50,15,"",1,0);
$pdf->Cell(80,15,"",0,0);
$pdf->Cell(50,15,$data['no_rm'],1,1,'C');

$pdf->SetFont('Arial','',12);

// $pdf->Ln();

$pdf->Ln();
$pdf->Cell(200,8,"LEMBAR CATATAN MEDIS",0,1,'C');
$pdf->Ln();
$pdf->Cell(35,7,"Nama",1,0,'R');
$pdf->Cell(155,7,$data['nama_pasien'],1,1,'L');
$pdf->Cell(35,7,"Tanggal Lahir ",1,0,'R');
$pdf->Cell(155,7,$data['tgl_lahir_pasien'],1,1,'L');
$pdf->Cell(35,7,"Alamat ",1,0,'R');
$pdf->Cell(155,7,$data['alamat_pasien'],1,1,'L');
$pdf->Cell(35,7,"Pekerjaan ",1,0,'R');
$pdf->Cell(155,7,$data['pekerjaan'],1,1,'L');
$pdf->Cell(35,7,"No.Telp ",1,0,'R');
$pdf->Cell(155,7,$data['no_hp_pasien'],1,1,'L');
$pdf->Cell(35,7,"No.BPJS ",1,0,'R');
$pdf->Cell(155,7,"",1,0);
$pdf->Ln();

$pdf->SetFont('Arial','',11);
$pdf->Cell(50,5,"",0,1,'C');
$pdf->Ln();
$pdf->Cell(22,5,"Tgl",1,0,'C');
$pdf->Cell(43,5,"Anamnesa",1,0,'C');
$pdf->Cell(30,5,"Lab",1,0,'C');
$pdf->Cell(30,5,"Diagnosis",1,0,'C');
$pdf->Cell(30,5,"Tindakan",1,0,'C');
$pdf->Cell(20,5,"Kode",1,0,'C');
$pdf->Cell(15,5,"Paraf",1,1,'C');

$pdf->Cell(22,50,$data['tanggal_kunjungan'],1,0,'C');
$pdf->Cell(43,50,"",1,0,'C');
$pdf->Cell(30,50,$data['lab'],1,0,'C');
$pdf->Cell(30,50,$data['diagnosa'],1,0,'C');
$pdf->Cell(30,50,$data['tindakan'],1,0,'C');
$pdf->Cell(20,50,"",1,0,'C');
$pdf->Cell(15,50,"",1,1,'C');

$pdf->Cell(22,50,"",1,0,'C');
$pdf->Cell(43,50,"",1,0,'C');
$pdf->Cell(30,50,"",1,0,'C');
$pdf->Cell(30,50,"",1,0,'C');
$pdf->Cell(30,50,"",1,0,'C');
$pdf->Cell(20,50,"",1,0,'C');
$pdf->Cell(15,50,"",1,1,'C');



$pdf->Output('I','Hasil_rekam_medis_'.$data['nama_pasien'].'.pdf');
?>