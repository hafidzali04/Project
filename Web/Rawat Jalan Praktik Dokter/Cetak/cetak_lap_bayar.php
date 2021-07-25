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

$bl=date_create($_POST['bulan']);
$bln= date_format($bl,'m');
// $bln = $_POST['bulan'];
$no_rm=array();
$nama=array();
$tgl_bayar=array();
$b_diagnosa=array();
$b_tindakan=array();
$b_resep=array();
$jumlah_bayar=array();
$i=0;

//header tabel
$pdf = new PDF('L','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',11);

$pdf->Ln();
$pdf->Cell(100);
$pdf->Cell(100,5,"LAPORAN PEMBAYARAN BULAN ".$nama_bulan." ".$tahun,0,1,'C');
$pdf->Ln();
$pdf->Cell(12,5,"NO.",1,0,'C');
$pdf->Cell(20,5,"RM",1,0,'C');
$pdf->Cell(23,5,"TGL BAYAR",1,0,'C');
$pdf->Cell(50,5,"NAMA",1,0,'C');
$pdf->Cell(40,5,"B. DIAGNOSA",1,0,'C');
$pdf->Cell(40,5,"B. TINDAKAN",1,0,'C');
$pdf->Cell(40,5,"B. RESEP",1,0,'C');
$pdf->Cell(50,5,"JUMLAH BAYAR",1,1,'C');

$pdf->SetFont('Arial','',11);

//ambil dr database
$sql=mysqli_query($koneksi,"SELECT * FROM tb_bayar b, tb_pasien p WHERE b.no_rm=p.no_rm AND MONTH(tgl_bayar)='$bln'");
$baris=mysqli_num_rows($sql);
if($baris<1)
{
    $pdf->tablewidths = array(275);
    $isi_tabel[] = array('TIDAK ADA PEMBAYARAN BULAN INI');
}else
{
    while($data=mysqli_fetch_array($sql))
    {
        $no_rm[$i]=$data['no_rm'];
        $nama[$i]=$data['nama_pasien'];
        $tgl_bayar[$i]=$data['tgl_bayar'];
        $b_diagnosa[$i]=$data['b_diagnosa'];
        $b_tindakan[$i]=$data['b_tindakan'];
        $b_resep[$i]=$data['b_resep'];
        $jumlah_bayar[$i]=$data['jumlah_bayar'];
        $i++;
    }
    $pdf->tablewidths = array(12, 20, 23, 50, 40, 40, 40, 50);
    for($k=0;$k<$i;$k++) {
        $isi_tabel[] = array($k+1, $no_rm[$k], $tgl_bayar[$k], $nama[$k],$b_diagnosa[$k], $b_tindakan[$k], $b_resep[$k], $jumlah_bayar[$k] );
    }

}

$pdf->morepagestable($isi_tabel);
$pdf->Output('I','file.pdf');
?>
//