<?php
include 'koneksi/koneksi.php';

$id=$_GET['id_periksa'];

 $sql=mysqli_query($koneksi,"UPDATE tb_pemeriksaan SET sts_obat='Sudah' WHERE id_periksa='$id' ");
 if($sql)
 {
 	echo " <script>alert('Pasien Sudah Diberi Obat'); 
			window.location.href='datarekammedis.php' </script>";
 }else{
 	
 	echo " <script>alert('Gagal Update'); 
			window.location.href='datarekammedis.php' </script>";
 }