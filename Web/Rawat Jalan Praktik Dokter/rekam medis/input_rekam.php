<?php
include 'koneksi/koneksi.php';

$no_rm=$_GET['id_pas'];
$nama=$_GET['nama'];
$id_dokter=$_GET['id_dok'];

$diagnosa=$_POST['diagnosa'];
$lab=$_POST['lab'];
$tindakan=$_POST['tindakan'];
$resep=$_POST['resep'];
$tgl=$_POST['tgl'];

 $sql=mysqli_query($koneksi,"INSERT INTO tb_pemeriksaan VALUES('','-','$id_dokter','$no_rm','$nama','$diagnosa','$lab','$tindakan','$resep','$tgl','Belum','Belum')");

 if($sql)
 {
 	echo " <script>alert('Berhasil Memasukkan Data Rekam Medis'); 
			window.location.href='datarekammedis.php' </script>";
 }else{
 	echo " <script>alert('Gagal Memasukkan Data Rekam Medis'); 
			window.location.href='formrekammedis.php' </script>";
 }