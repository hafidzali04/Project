<?php
require('morepagestable.php');
include 'koneksi/koneksi.php';

$bulan = array(
    '01' => 'JANUARI',
    '02' => 'FEBRUARI',
    '03' => 'MARET',
    '04' => 'APRIL',
    '05' => 'MEI',
    '06' => 'JUNI',
    '07' => 'JULI',
    '08' => 'AGUSTUS',
    '09' => 'SEPTEMBER',
    '10' => 'OKTOBER',
    '11' => 'NOVEMBER',
    '12' => 'DESEMBER',
);
$nama_bulan=$bulan[(date('m'))];
$tahun=date('Y');


$sql=mysqli_query($koneksi,"SELECT * FROM tb_obat");
$id=array();
$nama=array();
$jenis=array();
$jumlah=array();
$i=0;

while($data=mysqli_fetch_array($sql))
{
    $id[$i]=$data['id_obat'];
    $nama[$i]=$data['nama_obat'];
    $jenis[$i]=$data['jenis_obat'];
	$jumlah[$i]=$data['jumlah_obat'];
	$i++;
}

$pdf = new PDF('P','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);

$pdf->Ln();
$pdf->Cell(50);
$pdf->Cell(100,5,"LAPORAN OBAT BULAN ".$nama_bulan." ".$tahun,0,1,'C');
$pdf->Ln();
$pdf->Cell(15,8,"NO.",1,0,'C');
$pdf->Cell(15,8,"ID",1,0,'C');
$pdf->Cell(70,8,"NAMA",1,0,'C');
$pdf->Cell(60,8,"JENIS",1,0,'C');
$pdf->Cell(30,8,"JUMLAH",1,1,'C');

$pdf->SetFont('Arial','',12);
$pdf->tablewidths = array(15, 15, 70, 60, 30);

for($k=0;$k<$i;$k++) {
	$isi_tabel[] = array($k+1, $id[$k], $nama[$k], $jenis[$k],$jumlah[$k]);
}

$pdf->morepagestable($isi_tabel);
// $nama_doc='laporan-obat-bulan-'.$nama_bulan.$tahun.'.pdf';
$pdf->Output('D','laporan-obat.pdf');
?>