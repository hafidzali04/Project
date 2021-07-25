<?php
include "koneksi/koneksi.php";
session_start();

if (!empty($_SESSION['farmasi'])) 
{
	$user_terlogin = $_SESSION['farmasi'];
	$bidang="Petugas Farmasi";
}elseif (!empty($_SESSION['pelaporan'])) {
	$user_terlogin = $_SESSION['pelaporan'];
	$bidang="Petugas Laporan";
}elseif (!empty($_SESSION['admin'])) {
	$user_terlogin = $_SESSION['admin'];
	$bidang="Sys Admin";
}
else{
	echo "<script> alert('Silahkan Login Sebagai Petugas Farmasi/Pelaporan !!');
			window.location.href='Login%20form/login-page.php' </script>";
}

$sql = mysqli_query($koneksi,"SELECT * FROM tb_user WHERE id_user= '$user_terlogin'");
$data= mysqli_fetch_array($sql);

?>


<!DOCTYPE html>
<html class="no-js"> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Data Obat</title>
	
	
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
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

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
										<li><a href="datarekammedis.php">Rekam Medis</a></li>
										<!--petugas pendaftaran -->
										<?php 
										}elseif (!empty($_SESSION['pendaftaran'])) { ?>
										<li><a href="#">Data Pasien</a></li>
										<!--dokter & perawat -->
										<?php 
										}elseif (!empty($_SESSION['dokter'])) { ?>
										<li><a href="#">Rekam Medis</a></li>
										<li><a href="#">Data Pasien</a></li>
										<!--petugas pelaporan -->
										<?php 
										}elseif (!empty($_SESSION['pelaporan'])) { ?>
										<li><a href="dataobat.php">Laporan Obat</a></li>
										<li><a href="datarekammedis.php">Laporan Rekam Medis</a></li>
										<li><a href="datapasien.php">Laporan Pasien</a></li>
										<li><a href="datapembayaran.php">Laporan Pembayaran</a></li>
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
										<!--dokter & perawat -->
										<?php 
										}elseif (!empty($_SESSION['dokter'])) { ?>
										<li><a href="#">Rekam Medis</a></li>
										<li><a href="#">Tulis Resep</a></li>
										<!--admin-->
										<?php 
										}elseif (!empty($_SESSION['admin'])) { ?>
										<li><a href="formpasien.php">Input Pasien</a></li>
										<li><a href="formobat.php">Input Obat</a></li>
										<li><a href="formpembayaran.php">Input Pembayaran</a></li>
										<!--petugas pelaporan -->
										<?php 
										}elseif (!empty($_SESSION['pelaporan'])) { ?>
										
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
	<!-- tabel data -->
	<div class="container">
		<div class="row">
						<?php
						if (!empty($_SESSION['farmasi']) OR !empty($_SESSION['admin']) ) 
						{ ?>
			<div class="col-md-12">
				<form action="" method="POST" class="appointment-wrap animate-box" id="formcari">
					<div class="row form-group">
						<div class="col-md-12">
							<label for="email">Cari Obat</label>
							<input type="text" name="kunci" class="form-control" placeholder="Masukkan ID Obat atau Nama Obat">
						</div>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-xs" name="cari" form="formcari">
							<i class="material-icons">search</i> Cari
						</button>
						
						<button class="btn btn-primary btn-xs" onclick="location.href='dataobat.php">
							<i class="material-icons">autorenew</i> Refresh
						</button>
					</div>
				</form>
				
				<?php
                if(isset($_POST['cari']))
                {
                    $cari  = $_POST['kunci'];
                    // echo $cari." ini";
				    // $da  = mysqli_query($koneksi, "SELECT * FROM tb_obat WHERE nama_obat LIKE '%$cari%' OR id_obat LIKE '%$cari%'");
				    // $result=mysqli_fetch_array($da);
				    $data  = mysqli_query($koneksi, "SELECT * FROM tb_obat WHERE nama_obat LIKE '%$cari%' OR id_obat LIKE '%$cari%'");
				    // $res=$result;
				    ?>
			    <div class="table-responsive">
					<table class="table table-bordred table-striped">
			           <thead>
							<th>No.</th>
							<th>Nama Obat</th>
							<th>Jenis</th>
							<th>Jumlah</th>
							<th colspan="2">Opsi</th>
						</thead>
					    <tbody>
					    <?php
					    $i=0;
					    while($res=mysqli_fetch_array($data))
					    {
					    	$i=$i+1; ?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $res['nama_obat']; ?></td>
								<td><?php echo $res['jenis_obat']; ?></td>
								<td><?php echo $res['jumlah_obat']; ?></td>
								<td><button class="btn btn-primary btn-xs" onclick="location.href='edit_obat.php?id_ob=<?php echo $res['id_obat'];?>'"><i class="icon icon-edit"></button>
								</td>
								<td>
									<button class="btn btn-danger btn-xs" onclick="location.href='hapus_obat.php?id_ob=<?php echo $res['id_obat'];?>'; return confirm('Anda yakin ingin menghapus data obat <?php echo $res['nama_obat'];?> ?');"><i class="icon icon-trash"></button>
								</td>
							</tr>
					    <?php }
					    ?>
						</tbody>
			        </table>                
			    </div>
			    <?php } else{
                    ?>
                <div class="table-responsive">
					<table class="table table-bordred table-striped">

			           <thead>
							<th>No.</th>
							<th>Nama Obat</th>
							<th>Jenis</th>
							<th>Jumlah</th>
							<th colspan="2">Opsi</th>
						</thead>
					    <tbody>
					    <?php
					    $query=mysqli_query($koneksi, "SELECT * FROM tb_obat");
					    $i=0;
					    while($res=mysqli_fetch_array($query))
					    {
					    	$i=$i+1; ?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $res['nama_obat']; ?></td>
								<td><?php echo $res['jenis_obat']; ?></td>
								<td><?php echo $res['jumlah_obat']; ?></td>
								<td><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" onclick="location.href='edit_obat.php?id_ob=<?php echo $res['id_obat'];?>'">EDIT</button></td>
								<td><button class="btn btn-danger btn-xs" onclick="location.href='hapus_obat.php?id_ob=<?php echo $res['id_obat'];?>'; return confirm('Anda yakin ingin menghapus data obat <?php echo $res['nama_obat'];?> ?');">DELETE</button></p></td>
							</tr>
					    <?php }
					    ?>
						</tbody>
			        </table>                
			    </div>
			    <?php } ?>
			</div>
			<?php } ?>
						<?php
						if (!empty($_SESSION['pelaporan'])) 
						{ ?>
					<div class="table-responsive">
					<table class="table table-bordered table-striped">

			           <thead>
							<th>No.</th>
							<th>Nama Obat</th>
							<th>Jenis</th>
							<th>Jumlah</th>
						</thead>
					    <tbody>
					    <?php
					    $query=mysqli_query($koneksi, "SELECT * FROM tb_obat");
					    $i=0;
					    while($res=mysqli_fetch_array($query))
					    {
					    	$i=$i+1; ?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $res['nama_obat']; ?></td>
								<td><?php echo $res['jenis_obat']; ?></td>
								<td><?php echo $res['jumlah_obat']; ?></td>
								</tr>

					    <?php }
					    ?>
						</tbody>
			        </table>  
			        <button class="btn btn-primary btn-xs" onclick="location.href='cetak_obat.php'">Download Laporan Obat</button>             
			    </div>
			    <?php } ?>


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

