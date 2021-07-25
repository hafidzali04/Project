<?php
include 'koneksi/koneksi.php';

$id=$_GET['id_ob'];
$nama=$_POST['nama'];
$jenis=$_POST['jenis'];
$jumlah=$_POST['jml'];

 $sql=mysqli_query($koneksi,"UPDATE tb_obat SET nama_obat='$nama',jenis_obat='$jenis',jumlah_obat='$jumlah' WHERE id_obat='$id' ");
 if($sql)
 {
 	echo " <script>alert('Berhasil Mengedit Data Obat'); 
			window.location.href='dataobat.php' </script>";
 }else{
 	echo " <script>alert('Gagal Mengedit Data Obat'); 
			window.location.href='formobat.php' </script>";
 }