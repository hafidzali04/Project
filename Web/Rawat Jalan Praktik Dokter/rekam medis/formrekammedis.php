<?php
include "koneksi/koneksi.php";
session_start();

if (!empty($_SESSION['dokter'])) {
		$dokter_terlogin = $_SESSION['dokter'];
		$sql = mysqli_query($koneksi,"SELECT * FROM tb_dokter WHERE id_dokter = '$dokter_terlogin'");
		

}else
{
	echo "<script> alert('Silahkan Login Terlebih Sebagai Dokter/Perawat !!');
			window.location.href='Login%20form/login-page.php' </script>";
}

$data= mysqli_fetch_array($sql);
$id_dok=$data['id_dokter'];



?>

<!DOCTYPE html>
<html class="no-js"> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Input Rekam Medis</title>
	
	
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
										<?php
										if (!empty($_SESSION['dokter'])) 
										{ ?>
										<p><a href="#">	<?php echo  $data['nama_dokter'];?>  </a></p>
										<p><a href="#">	<?php echo  $data['id_dokter'];?>  </a></p>
										
										<?php }
										?>
										<?php
										if (!empty($_SESSION['farmasi']) OR !empty($_SESSION['pembayaran']) OR !empty($_SESSION['pendaftaran']) OR !empty($_SESSION['pelaporan']) OR !empty($_SESSION['perawat'])) 
										{ ?>
										<p><a href="#">	<?php echo  $data['id_user'];?>  </a></p>
										<p><a href="#">	<?php echo  $bidang;?>  </a></p>  </a></p>
										<?php }
										?>	
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
										<li><a href="datapasien.php">Data Pasien</a></li>
										<!--dokter & perawat -->
										<?php 
										}elseif (!empty($_SESSION['dokter']) OR !empty($_SESSION['perawat'])) { ?>
										<li><a href="datarekammedis.php">Rekam Medis</a></li>
										<li><a href="datapasien.php">Data Pasien</a></li>
										<!--petugas pelaporan -->
										<?php 
										}elseif (!empty($_SESSION['pelaporan'])) { ?>
										<li><a href="#">Data Penyakit</a></li>
										<li><a href="#">Data Kunjungan</a></li>
										<li><a href="#">Data Obat</a></li>
										<li><a href="#">Data Obat</a></li>
										<li><a href="#">Data Keuangan</a></li>
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
										<li><a href="formpasien.php">Input Pasien</a></li>
										<!--dokter & perawat -->
										<?php 
										}elseif (!empty($_SESSION['dokter']) OR !empty($_SESSION['perawat'])) { ?>
										<li><a href="formrekammedis.php">Rekam Medis</a></li>
										<li><a href="formrujukan.php">Rujukan</a></li>
										<!--petugas pelaporan -->
										<?php 
										}elseif (!empty($_SESSION['pelaporan'])) { ?>
										<li><a href="#">Laporan Penyakit</a></li>
										<li><a href="#">Laporan Kunjungan</a></li>
										<li><a href="#">Laporan Obat</a></li>
										<li><a href="#">Laporan Tindakan</a></li>
										<li><a href="#">Laporan Keuangan</a></li>
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
				
				<h2 class="col-md-6 col-md-offset-3 text-center">Input Rekam Medis</h2>
				<div class="col-md-8 col-md-offset-2">
					<form action="" method="POST" class="appointment-wrap animate-box">
						<div class="row form-group">
							<div class="col-md-12">
								<label>Cari Pasien</label>
								<input type="text" name="kunci" class="form-control" placeholder="Masukkan Nama atau No. Rekam Medis">
							</div>
						</div>
						<div class="form-group">
							<input type="submit" name="cari" value="Cari" class="btn btn-primary">
						</div>
					</form>
					<?php
                    if(isset($_POST['cari']))
                    {
                    	$cari  = $_POST['kunci'];

                        // echo $cari." ini";
                        $da  = mysqli_query($koneksi, "SELECT * FROM tb_pasien WHERE nama_pasien LIKE '%$cari%' OR no_rm LIKE '%$cari%'");
					    $result=mysqli_fetch_array($da);
					    $query  = mysqli_query($koneksi, "SELECT * FROM tb_pasien WHERE nama_pasien LIKE '%$cari%' OR no_rm LIKE '%$cari%'");
					    $row=mysqli_num_rows($query);
					    if($row > 1){ ?>

					<div class="table-responsive col-md-12">
						<table class="table table-bordred table-striped col-md-4">
							<thead>
								<th>No. RM</th>
								<th>Nama</th>
								<th>Tanggal Lahir</th>
								<th>Alamat</th>
								<th>Jenis Kelamin</th>
								<th>Pekerjaan</th>
								<th>Nama Keluarga</th>
								<th colspan="2">Opsi</th>
							</thead>
				            <tbody>
						    <?php 
						    $i=0;
						    while($res=mysqli_fetch_array($query))
						    { ?>
						    	<tr>
									<td><?php echo $res['no_rm']; ?></td>
									<td><?php echo $res['nama_pasien']; ?></td>
									<td><?php echo $res['tgl_lahir_pasien']; ?></td>
									<td><?php echo $res['alamat_pasien']; ?></td>
									<td><?php echo $res['jenis_kelamin']; ?></td>
									<td><?php echo $res['pekerjaan']; ?></td>
									<td><?php echo $res['nama_keluarga']; ?></td>
									<td><button class="btn btn-primary btn-xs" onclick="location.href='formrekammedis2.php?carikey=<?php echo $res['no_rm'];?>'"><i class="icon icon-check">Pilih</i></button>
									</td>
								</tr>
						    <?php }
						    
						    ?>
							</tbody>
				        </table>                
				    </div>
					    <?php }elseif (($row == 1))
					    {
					    						    	
					     ?>
					<div class="table-responsive col-md-6">
						<table class="table table-bordred table-striped col-md-4">
				            <tbody>
						    <?php 
						    $i=0;
						    while($res=mysqli_fetch_array($query))
						    {
						    	$i=$i+1; ?>
						    	<tr>
						    		<td>Id Dokter</td>
						    		<td>:</td>
						    		<td><?php echo $id_dok; ?></td>
						    	</tr>
						    	<tr>

									<td>Nama</td>
									<td>:</td>
									<td><?php echo $res['nama_pasien']; ?></td>
						    		
						    	</tr>

								<tr>
									<td>Alamat</td>
									<td>:</td>
									<td><?php echo $res['alamat_pasien']; ?></td>
								</tr>
						    <?php }
						    
						    ?>
							</tbody>
				        </table>                
				    </div>
				    <form method="POST" action="input_rekam.php?id_pas=<?php echo $result['no_rm'];?>&nama=<?php echo $result['nama_pasien'];?>&id_dok=<?php echo $id_dok;?>">
				    	<div class="row form-group">
							<div class="col-md-12">
								<label for="email">Diagnosa</label>
								<input type="text" name="diagnosa" class="form-control" placeholder="Diagnosa Dokter">
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<label for="email">Laboratorium</label>
								<input type="text" name="lab" class="form-control" placeholder="Laboratorium">
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<label for="email">Tindakan</label>
								<input type="text" name="tindakan" class="form-control" placeholder="Tindakan Dokter">
							</div>
						</div>

						<div class="row form-group">
							<div class="col-md-12">
								<label for="email">Resep</label>
								<input type="text" name="resep" class="form-control" placeholder="Resep Obat">
							</div>
						</div>

						<div class="row form-group">
							<div class="col-md-6">
								<label for="email">Tanggal Periksa</label>
								<input type="date" name="tgl" class="form-control" placeholder="Tanggal Periksa">
							</div>
						</div>
						
						<div class="form-group">
							<input type="submit" name="input" value="Input" class="btn btn-primary">
						</div>
				    </form>
					<?php }else { ?>

					<div class="col-md-12 alert alert-danger" role="alert">
						<h2 class="col-md-6 col-md-offset-3 text-center">Data Pasien Belum Ada</h2>
						
					</div>					


					<?php	} 
					}
                        ?>
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

