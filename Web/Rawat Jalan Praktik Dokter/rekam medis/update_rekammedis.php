<?php
include 'koneksi/koneksi.php';

$id_rekam=$_GET['id_rekam'];
$diagnosa=$_POST['diagnosa'];
$lab=$_POST['lab'];
$tindakan=$_POST['tindakan'];
$resep=$_POST['resep'];
$tanggal_kunjungan=$_POST['tgl'];




 $sql=mysqli_query($koneksi,"UPDATE tb_pemeriksaan SET diagnosa='$diagnosa', lab='$lab', tindakan='$tindakan', resep='$resep', tanggal_kunjungan='$tanggal_kunjungan' WHERE id_periksa='$id_rekam' ");
 if($sql)
 {
 	echo " <script>alert('Berhasil Mengedit Data Pasien'); 
			window.location.href='datarekammedis.php' </script>";
 }else{
 	echo " <script>alert('Gagal Mengedit Data Pasien'); 
			window.location.href='edit_rekammedis.php?id_pas=$no_rm' </script>";
 }