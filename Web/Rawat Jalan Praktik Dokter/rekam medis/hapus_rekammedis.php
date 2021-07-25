<?php
include "koneksi/koneksi.php";
$id=$_GET['id_rekam'];
$sql=mysqli_query($koneksi,"DELETE FROM tb_pemeriksaan WHERE id_periksa='$id'");
if ($sql) {
    echo " <script>alert('Data Berhasil Dihapus'); 
			window.location.href='datarekammedis.php' </script>";
} else {
	echo $id;
	echo "gagal";

   //  echo " <script>alert('Data Gagal Dihapus'); 
			// window.location.href='datarekammedis.php' </script>";
}
?>

<!-- DELETE FROM `tb_pemeriksaan` WHERE `tb_pemeriksaan`.`id_periksa` = 18 -->