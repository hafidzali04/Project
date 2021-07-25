<?php
include "koneksi/koneksi.php";
session_start();

if (!empty($_SESSION['dokter']) OR !empty($_SESSION['farmasi']) OR !empty($_SESSION['pembayaran']) OR !empty($_SESSION['pendaftaran']) OR !empty($_SESSION['pelaporan']) OR !empty($_SESSION['perawat']) OR !empty($_SESSION['admin']) ) {
	if (!empty($_SESSION['dokter'])) 
	{
		$user_terlogin = $_SESSION['dokter'];
		$bidang="Dokter";
	}elseif (!empty($_SESSION['farmasi'])) 
	{
		$user_terlogin = $_SESSION['farmasi'];
		$bidang="Petugas Farmasi";
	}elseif (!empty($_SESSION['perawat'])) 
	{
		$user_terlogin = $_SESSION['perawat'];
		$bidang="Petugas Perawat";
	}elseif (!empty($_SESSION['pendaftaran'])) 
	{
		$user_terlogin = $_SESSION['pendaftaran'];
		$bidang="Petugas Pendaftaran";
	}elseif (!empty($_SESSION['pelaporan']))
	 {
		$user_terlogin = $_SESSION['pelaporan'];
		$bidang="Petugas Pelaporan";
	}elseif (!empty($_SESSION['admin']))
	 {
		$user_terlogin = $_SESSION['admin'];
		$bidang="sys admin";
	}else
	{
		$user_terlogin = $_SESSION['pembayaran'];
		$bidang="Petugas Pembayaran";
	}
	$sql = mysqli_query($koneksi,"SELECT * FROM tb_user WHERE id_user= '$user_terlogin'");

}
else
{
	echo "<script> alert('Silahkan Login Terlebih Dahulu !!');
			window.location.href='Login%20form/login-page.php' </script>";
}


$data= mysqli_fetch_array($sql);

?>
<!DOCTYPE html>
<<html class="no-js"> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Form Obat</title>
	
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">
	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	<!-- Flexslider  -->
	<link rel="stylesheet" href="css/flexslider.css">
	<!-- Theme style  -->
	<link rel="stylesheet" href="css/style.css">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body>
		
	<div class="qbootstrap-loader"></div>
	
	<div id="page">
	<nav class="qbootstrap-nav" role="navigation">
		<div class="top-menu">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="top">
							<div class="row">
								<div class="col-md-4 col-md-push-4 text-center">
									<div id="qbootstrap-logo"><a href="index.php"><i class="icon-plus-outline"></i>Med<span>care</span></a></div>
								</div>
								<div class="col-md-4 col-md-pull-4">
									<div class="num">
										<span class="icon"><i class="icon-phone"></i></span>
										<p><a href="#">111-222-333</a><br><a href="#">99-222-333</a></p>
									</div>
								</div>
								<div class="col-md-4">
									<div class="loc">
										<span class="icon"><i class="icon-location"></i></span>
										<p><a href="#">	<?php echo  $data['id_user'];?>  </a></p>
										<p><a href="#">	<?php echo  $bidang;?>  </a></p>
										
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xs-12 text-center">
						<div class="menu-1">
							<ul>
								<li class="active"><a href="home.php">Home</a></li>
								<li class="has-dropdown">
									<a href="#">Data</a>
									<ul class="dropdown">
										<!--petugas farmasi -->
										
										<?php
										if (!empty($_SESSION['farmasi']) ) 
										{ ?>
										<li><a href="dataobat.php">Data Obat</a></li>
										<!--petugas pendaftaran -->
										<?php 
										}elseif (!empty($_SESSION['pendaftaran'])) { ?>
										<li><a href="#">Data Pasien</a></li>
										<!--dokter & perawat -->
										<?php 
										}elseif (!empty($_SESSION['dokter']) OR !empty($_SESSION['perawat'])) { ?>
										<li><a href="#">Rekam Medis</a></li>
										<li><a href="#">Data Pasien</a></li>
										<!--Admin-->
										<?php 
										}elseif (!empty($_SESSION['admin'])) { ?>
										<li><a href="datapasien.php">Data Pasien</a></li>
										<li><a href="dataobat.php">Data Obat</a></li>
										<li><a href="datarekammedis.php">Data Rekam Medis</a></li>
										<li><a href="datapembayaran.php">Data Pembayaran</a></li>
										<!--petugas pembayaran -->
										<?php 
										}else{ ?> 
										<li><a href="#">Data Pembayaran</a></li>
										<?php }
										?>										
									</ul>
								</li>
								<li class="has-dropdown">
									<a href="#">Input</a>
									<ul class="dropdown">
										<?php
										if (!empty($_SESSION['farmasi']) ) 
										{ ?>
										<li><a href="formobat.php">Input Obat</a></li>
										<!--petugas pendaftaran -->
										<?php 
										}elseif (!empty($_SESSION['pendaftaran'])) { ?>
										<li><a href="#">Input Pasien</a></li>
										<!--admin-->
										<?php 
										}elseif (!empty($_SESSION['admin'])) { ?>
										<li><a href="formpasien.php">Input Pasien</a></li>
										<li><a href="formobat.php">Input Obat</a></li>
										<li><a href="formpembayaran.php">Input Pembayaran</a></li>
										<!--dokter & perawat -->
										<?php 
										}elseif (!empty($_SESSION['dokter']) OR !empty($_SESSION['perawat'])) { ?>
										<li><a href="#">Rekam Medis</a></li>
										<li><a href="#">Tulis Resep</a></li>
										<!--petugas pembayaran -->
										<?php 
										}else{ ?> 
										<li><a href="#">Input Pembayaran</a></li>
										<?php }
										?>	
										
									</ul>
								</li>
								
								<li class="btn-cta"><a href="Login%20form/logout.php"><span>Logout</i></span></a></li>
															</ul>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</nav>
	


	<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<h2 class="text-center">Input Data Obat</h2>
					<form action="input_obat.php" method="POST" class="appointment-wrap animate-box">
						<div class="row form-group">
							<div class="col-md-6">
								<label for="fname">ID Obat</label>
								<input type="text" name="id" class="form-control" placeholder="ID Obat">
							</div>
						</div>

						<div class="row form-group">
							<div class="col-md-6">
								<label for="fname">Nama</label>
								<input type="text" id="name" name="nama" class="form-control" placeholder="Nama Obat">
							</div>
						</div>
							
						<div class="row form-group">
							<div class="col-md-12">
								<label for="subject">Jenis Obat</label>
								<select name="jenis" class="selectpicker form-control">
								   <option value="-"></option>
								   <option value="1">Kapsul</option>
								   <option value="2">Tablet</option>
								   <option value="3">Cair</option>
								   <option value="4">Bubuk</option>
								</select>

							</div>
						</div>
						
						<div class="row form-group">
							<div class="col-md-6">
								<label for="fname">Jumlah</label>
								<input type="num" id="name" name="jml" class="form-control" placeholder="Jumlah Obat">
							</div>
						</div>

						
						<div class="form-group">
							<input type="submit" name="input" value="Input" class="btn btn-primary">
						</div>

					</form>
				</div>
			</div>
		</div>

	
<div class="row copyright">
			<div class="col-md-12 text-center">
				<p>
                    <small class="block">&copy; 2019 Sistem Informasi Manajemen Pendaftaran Rawat Jalan.</small> 
                   
                </p>
			</div>
		</div>
	</footer>
	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>
	
	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Stellar Parallax -->
	<script src="js/jquery.stellar.min.js"></script>
	<!-- Carousel -->
	<script src="js/owl.carousel.min.js"></script>
	<!-- Flexslider -->
	<script src="js/jquery.flexslider-min.js"></script>
	<!-- countTo -->
	<script src="js/jquery.countTo.js"></script>
	<!-- Magnific Popup -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	<!-- Sticky Kit -->
	<script src="js/sticky-kit.min.js"></script>
	<!-- Main -->
	<script src="js/main.js"></script>

	</body>
</html>

