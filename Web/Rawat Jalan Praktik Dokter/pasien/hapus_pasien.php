<?php
include "koneksi/koneksi.php";
$id=$_GET['id_pas'];
$sql=mysqli_query($koneksi,"DELETE FROM tb_pasien WHERE no_rm='$id'");
if ($sql) {
    echo " <script>alert('Data Berhasil Dihapus'); 
			window.location.href='datapasien.php' </script>";
} else {
    echo " <script>alert('Data Gagal Dihapus'); 
			window.location.href='datapasien.php' </script>";
}
?>