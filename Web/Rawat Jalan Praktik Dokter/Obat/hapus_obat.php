<?php
include "koneksi/koneksi.php";
$id=$_GET['id_ob'];
$sql=mysqli_query($koneksi,"DELETE FROM tb_obat WHERE id_obat='$id'");
if ($sql) {
    echo " <script>alert('Data Berhasil Dihapus'); 
			window.location.href='dataobat.php' </script>";
} else {
    echo " <script>alert('Data Gagal Dihapus'); 
			window.location.href='dataobat.php' </script>";
}
?>