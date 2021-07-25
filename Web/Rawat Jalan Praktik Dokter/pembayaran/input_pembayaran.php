<?php
include 'koneksi/koneksi.php';

$id_periksa=$_GET['id_peri'];
$no_rm	=$_GET['no_rm'];

$tgl_bayar =$_POST['tgl'];	
$b_diagnosa =$_POST['diagnosa'];	
$b_tindakan	=$_POST['tindakan'];
$b_resep =$_POST['resep'];
$jumlah_bayar =$_POST['total'];

 $sql=mysqli_query($koneksi,"INSERT INTO tb_bayar VALUES('', '$id_periksa',	'$no_rm', '$tgl_bayar',	'$b_diagnosa', '$b_tindakan', '$b_resep', '$jumlah_bayar')");
 if($sql)
 {
 	$que= mysqli_query($koneksi,"UPDATE tb_pemeriksaan SET sts_bayar='Sudah' WHERE id_periksa='$id_periksa' ");
 	echo " <script>alert('Berhasil melakukan Pembayaran'); 
			window.location.href='datapembayaran.php' </script>";

 }else{
 	echo " <script>alert('Pembayaran Gagal !'); 
			window.location.href='formpembayaran.php' </script>";
 }