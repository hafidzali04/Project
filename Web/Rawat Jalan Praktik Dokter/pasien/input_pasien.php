<?php
include 'koneksi/koneksi.php';

$us=$_GET['user'];
$no_rm=$_POST['no_rm'];
$tgl_daftar=$_POST['tgl_daftar'];
$nama=$_POST['nama'];
$alamat=$_POST['alm'];
$telp=$_POST['tel'];
$tgl=$_POST['tanggal'];
$agama=$_POST['agama'];
$jk=$_POST['jk'];
$pekerjaan=$_POST['pekerjaan'];
$status=$_POST['status'];
$namkel=$_POST['namkel'];

 $sql=mysqli_query($koneksi,"INSERT INTO tb_pasien VALUES('$no_rm','$tgl_daftar','$nama','$tgl','$alamat','$telp','$agama','$jk','$pekerjaan','$status','$namkel','$us')");
 if($sql)
 {
 	echo " <script>alert('Berhasil Memasukkan Data Pasien'); 
			window.location.href='datapasien.php' </script>";
 }else{
 	echo " <script>alert('Gagal Memasukkan Data Pasien'); 
			window.location.href='formpasien.php' </script>";
 }