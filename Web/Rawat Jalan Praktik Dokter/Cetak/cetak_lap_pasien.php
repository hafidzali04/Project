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

// echo $bln." ini yg bulan";
// $bln = $_POST['bulan'];

$no_rm=array();
$tgl_daftar=array();
$nama=array();
$tgl_lahir=array();
$alamat=array();
$no_hp=array();
$agama=array();
$jk=array();
$pekerjaan=array();
$status=array();
$keluarga=array();
$i=0;

//header tabel
$pdf = new PDF('L','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',11);

$pdf->Ln();
$pdf->Cell(100);
$pdf->Cell(100,5,"LAPORAN PASIEN BULAN ".$nama_bulan." ".$tahun,0,1,'C');
$pdf->Ln();
$pdf->Cell(12,5,"NO.",1,0,'C');
$pdf->Cell(20,5,"RM",1,0,'C');
$pdf->Cell(23,5,"DAFTAR",1,0,'C');
$pdf->Cell(40,5,"NAMA",1,0,'C');
$pdf->Cell(23,5,"TGL LAHIR",1,0,'C');
$pdf->Cell(40,5,"ALAMAT",1,0,'C');
$pdf->Cell(25,5,"TELEPON",1,0,'C');
$pdf->Cell(20,5,"AGAMA",1,0,'C');
$pdf->Cell(10,5,"P/L",1,0,'C');
$pdf->Cell(25,5,"PEKERJAAN",1,0,'C');
$pdf->Cell(40,5,"KELUARGA",1,1,'C');

$pdf->SetFont('Arial','',11);

//ambil dr database
$query=mysqli_query($koneksi,"SELECT * FROM tb_pasien WHERE MONTH(tgl_daftar)='$bln'");
$baris=mysqli_num_rows($query);
if($baris<1)
{
    $pdf->tablewidths = array(278);
    $isi_tabel[] = array('TIDAK ADA PENDAFTAR BULAN INI');
}else
{
    while($data=mysqli_fetch_array($query))
    {
        $no_rm[$i]=$data['no_rm'];
        $tgl_daftar[$i]=$data['tgl_daftar'];
        $nama[$i]=$data['nama_pasien'];
        $tgl_lahir[$i]=$data['tgl_lahir_pasien'];
        $alamat[$i]=$data['alamat_pasien'];
        $no_hp[$i]=$data['no_hp_pasien'];
        $agama[$i]=$data['agama'];
        $jk[$i]=$data['jenis_kelamin'];
        $pekerjaan[$i]=$data['pekerjaan'];
        $status[$i]=$data['status'];
        $keluarga[$i]=$data['nama_keluarga'];
        $i++;
    }
    $pdf->tablewidths = array(12, 20, 23, 40, 23, 40, 25, 20, 10, 25, 40);
    for($k=0;$k<$i;$k++) {
        $isi_tabel[] = array($k+1, $no_rm[$k], $tgl_daftar[$k], $nama[$k], $tgl_lahir[$k], $alamat[$k], $no_hp[$k], $agama[$k], $jk[$k], $pekerjaan[$k], $keluarga[$k]);
    }

}

$pdf->morepagestable($isi_tabel);
$pdf->Output('I','file.pdf');
?>
//
