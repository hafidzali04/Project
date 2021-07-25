<?php
include "../koneksi/koneksi.php";

$user = $_POST['username'];
$pass = $_POST['password'];

if(isset($_POST['login']))
{
	$sql=mysqli_query($koneksi, "SELECT * FROM tb_user WHERE id_user='$user' AND password='$pass'");
	while ($data= mysqli_fetch_array($sql)) {
		$id = $data['id_user'];
		$kode = $data['password'];
		$bidang = $data['bidang'];
	}

	if(($user == "") || ($pass == "") ){
		echo "<script>alert('Username atau Password Tidak Boleh Kosong!!');
		window.location.href='login-page.php' </script>";
	}

	if(($user == $id) and ($pass == $kode))
	{
		if ($bidang=='farmasi') {
			session_start();
			$_SESSION['farmasi'] = $id;
			
			echo " <script>alert('Berhasil Login sebagai Petugas Farmasi'); 
				window.location.href='../home.php' </script>";
		}elseif ($bidang=='pembayaran') {
			session_start();
			$_SESSION['pembayaran'] = $id;
			
			echo " <script>alert('Berhasil Login sebagai Petugas Pembayaran'); 
				window.location.href='../home.php' </script>";
		}elseif ($bidang=='pendaftaran') {
			session_start();
			$_SESSION['pendaftaran'] = $id;
			
			echo " <script>alert('Berhasil Login sebagai Petugas Pendaftaran'); 
				window.location.href='../home.php' </script>";
		}elseif ($bidang=='pelaporan') {
			session_start();
			$_SESSION['pelaporan'] = $id;
			
			echo " <script>alert('Berhasil Login sebagai Petugas Pelaporan'); 
				window.location.href='../home.php' </script>";
		}elseif ($bidang=='perawat') {
			session_start();
			$_SESSION['perawat'] = $id;
			
			echo " <script>alert('Berhasil Login sebagai Perawat'); 
				window.location.href='../home.php' </script>";
		}elseif ($bidang=='admin') {
			session_start();
			$_SESSION['admin'] = $id;
			
			echo " <script>alert('Berhasil Login sebagai Admin'); 
				window.location.href='../home.php' </script>";
		}
		
		
	}
	else
	{
		echo "<script> alert('Username atau Password anda salah !!');
			window.location.href='login-page.php' </script>";
	}
}
?>