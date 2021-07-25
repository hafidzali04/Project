<?php
include "../koneksi/koneksi.php";

$user = $_POST['username'];
$pass = $_POST['password'];

if(isset($_POST['login']))
{
	$sql=mysqli_query($koneksi, "SELECT * FROM tb_dokter WHERE id_dokter='$user' AND password='$pass'");
	while ($data= mysqli_fetch_array($sql)) {
		$id = $data['id_dokter'];
		$nama = $data['nama_dokter'];
		$userr = $data['id_dokter'];
		$kode = $data['password'];

	}

	if(($user == "") || ($pass == "") ){
		echo "<script>alert('Username atau Password Tidak Boleh Kosong!!');
		window.location.href='login-page-pegawai.php' </script>";
	}

	if(($user == $userr) and ($pass == $kode))
	{
		session_start();
		$_SESSION['dokter'] = $id;
		
		echo " <script>alert('Berhasil Login sebagai Dokter'); 
			window.location.href='../home.php' </script>";
		
	}
	else
	{
		echo "<script> alert('Username atau Password anda salah !!');
			window.location.href='login-page-Dokter.php' </script>";
	}
}
?>