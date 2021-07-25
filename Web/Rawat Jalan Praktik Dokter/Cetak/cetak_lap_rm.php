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
// $bln = $_POST['bulan'];

$bl=date_create($_POST['bulan']);
$bln= date_format($bl,'m');

$no_rm=array();
$nama_pasien=array();
$diagnosa=array();
$lab=array();
$tindakan=array();
$resep=array();
$tanggal_kunjungan=array();
$i=0;

//header tabel
$pdf = new PDF('L','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',11);

$pdf->Ln();
$pdf->Cell(100);
$pdf->Cell(80,5,"LAPORAN REKAM MEDIS BULAN ".$nama_bulan." ".$tahun,0,1,'C');
$pdf->Ln();
$pdf->Cell(12,5,"NO.",1,0,'C');
$pdf->Cell(20,5,"RM",1,0,'C');
$pdf->Cell(45,5,"NAMA",1,0,'C');
$pdf->Cell(40,5,"DIAGNOSA",1,0,'C');
$pdf->Cell(40,5,"LAB",1,0,'C');
$pdf->Cell(40,5,"TINDAKAN",1,0,'C');
$pdf->Cell(40,5,"RESEP",1,0,'C');
$pdf->Cell(35,5,"TGL KUNJUNGAN",1,1,'C');
$pdf->SetFont('Arial','',11);

//ambil dr database
$sql=mysqli_query($koneksi,"SELECT * FROM tb_pemeriksaan WHERE MONTH(tanggal_kunjungan)='$bln'");
$baris=mysqli_num_rows($sql);
if($baris<1)
{
    $pdf->tablewidths = array(272);
    $isi_tabel[] = array('TIDAK ADA DATA PEMERIKSAAN BULAN INI');
}else
{
    while($data=mysqli_fetch_array($sql))
    {
        $no_rm[$i]=$data['no_rm'];
        $nama_pasien[$i]=$data['nama_pasien'];
        $diagnosa[$i]=$data['diagnosa'];
        $lab[$i]=$data['lab'];
        $tindakan[$i]=$data['tindakan'];
        $resep[$i]=$data['resep'];
        $tanggal_kunjungan[$i]=$data['tanggal_kunjungan'];
        $i++;
    }
    $pdf->tablewidths = array(12, 20, 45, 40, 40, 40, 40, 35);
    for($k=0;$k<$i;$k++) {
        $isi_tabel[] = array($k+1, $no_rm[$k], $nama_pasien[$k], $diagnosa[$k], $lab[$k], $tindakan[$k], $resep[$k], $tanggal_kunjungan[$k]);
    }

}

$pdf->morepagestable($isi_tabel);
$pdf->Output('I','file.pdf');
?>
//