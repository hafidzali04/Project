<?php
include 'koneksi/koneksi.php';

$no_rm=$_GET['id_pas'];

$nama=$_POST['nama'];
$alamat=$_POST['alm'];
$telp=$_POST['tel'];
$tgl=$_POST['tanggal'];
$agama=$_POST['agama'];
$jk=$_POST['jk'];
$pekerjaan=$_POST['pekerjaan'];
$status=$_POST['status'];
$namkel=$_POST['namkel'];

 $sql=mysqli_query($koneksi,"UPDATE tb_pasien SET nama_pasien='$nama', alamat_pasien='$alamat', no_hp_pasien='$telp', tgl_lahir_pasien='$tgl', agama='$agama', jenis_kelamin='$jk', pekerjaan='$pekerjaan', status='$status', nama_keluarga='$namkel' WHERE no_rm='$no_rm' ");
 if($sql)
 {
 	echo " <script>alert('Berhasil Mengedit Data Pasien'); 
			window.location.href='datapasien.php' </script>";
 }else{
 	echo " <script>alert('Gagal Mengedit Data Pasien'); 
			window.location.href='edit_pasien.php?id_pas=$no_rm' </script>";
 }