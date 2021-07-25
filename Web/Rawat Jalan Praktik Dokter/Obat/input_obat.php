<?php
include 'koneksi/koneksi.php';

$id=$_POST['id'];
$nama=$_POST['nama'];
$jenis=$_POST['jenis'];
$jumlah=$_POST['jml'];

 $sql=mysqli_query($koneksi,"INSERT INTO tb_obat VALUES('$id','$nama','$jenis','$jumlah')");
 if($sql)
 {
 	echo " <script>alert('Berhasil Memasukkan Data Obat'); 
			window.location.href='dataobat.php' </script>";
 }else{
 	echo " <script>alert('Gagal Memasukkan Data Obat'); 
			window.location.href='formobat.php' </script>";
 }