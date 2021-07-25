<?php
include "koneksi/koneksi.php";
session_start();

if (!empty($_SESSION['dokter'])) {
		$dokter_terlogin = $_SESSION['dokter'];
		$sql = mysqli_query($koneksi,"SELECT * FROM tb_dokter WHERE id_dokter = '$dokter_terlogin'");


}elseif (!empty($_SESSION['farmasi'])) 
{
	$user_terlogin = $_SESSION['farmasi'];
	$bidang="Petugas Farmasi";
	$sql = mysqli_query($koneksi,"SELECT * FROM tb_user WHERE id_user= '$user_terlogin'");
}elseif (!empty($_SESSION['pelaporan'])) 
{
	$user_terlogin = $_SESSION['pelaporan'];
	$bidang="Petugas Pelaporan";$sql = mysqli_query($koneksi,"SELECT * FROM tb_user WHERE id_user= '$user_terlogin'");
}elseif (!empty($_SESSION['admin'])) 
{
	$user_terlogin = $_SESSION['admin'];
	$bidang="sys admin";$sql = mysqli_query($koneksi,"SELECT * FROM tb_user WHERE id_user= '$user_terlogin'");
}else
{
	echo "<script> alert('Silahkan Login Terlebih Sebagai Dokter/Perawat !!');
			window.location.href='Login%20form/login-page.php' </script>";
}

$data= mysqli_fetch_array($sql);


?>

<!DOCTYPE html>
<html class="no-js"> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Data Rekam Medis</title>
	
	
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
										<?php
										if (!empty($_SESSION['dokter'])) 
										{ ?>
										<p><a href="#">	<?php echo  $data['nama_dokter'];?>  </a></p>
										<?php }
										?>
										<?php
										if (!empty($_SESSION['farmasi']) OR !empty($_SESSION['pembayaran']) OR !empty($_SESSION['pendaftaran']) OR !empty($_SESSION['pelaporan']) OR !empty($_SESSION['perawat']) OR !empty($_SESSION['admin'])) 
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
										<li><a href="datarekammedis.php">Rekam Medis</a></li>
										<!--petugas pendaftaran -->
										<?php 
										}elseif (!empty($_SESSION['pendaftaran'])) { ?>
										<li><a href="datapasien.php">Data Pasien</a></li>
										<!--dokter & perawat -->
										<?php 
										}elseif (!empty($_SESSION['dokter'])) { ?>
										<li><a href="datarekammedis.php">Rekam Medis</a></li>
										<li><a href="datapasien.php">Data Pasien</a></li>
										<!--Admin-->
										<?php 
										}elseif (!empty($_SESSION['admin'])) { ?>
										<li><a href="datapasien.php">Data Pasien</a></li>
										<li><a href="dataobat.php">Data Obat</a></li>
										<li><a href="datarekammedis.php">Data Rekam Medis</a></li>
										<li><a href="datapembayaran.php">Data Pembayaran</a></li>
										<!--petugas pelaporan -->
										<?php 
										}elseif (!empty($_SESSION['pelaporan'])) { ?>
										<li><a href="dataobat.php">Laporan Obat</a></li>
										<li><a href="datarekammedis.php">Laporan Rekam Medis</a></li>
										<li><a href="datapasien.php">Laporan Pasien</a></li>
										<li><a href="datapembayaran.php">Laporan Pembayaran</a></li>
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
			<h2 class="text-center">Data Rekam Medis</h2>
			<div class="col-md-12">
				<div class="table-responsive">
					<table class="table table-bordered table-striped">

						<thead>
							<th>No. Pemeriksaan</th>
							<th>Nama Pasien</th>

							<?php
							if(!empty($_SESSION['dokter']) OR !empty(($_SESSION['pelaporan'])))
							{?>
							<th>Diagnosa</th>
							<th>Lab</th>
							<th>Tindakan</th>

							<?php } ?>
							
							<th>Resep</th>
							<th>Tanggal Periksa</th>

							<?php
							if(!empty($_SESSION['dokter']))
							{?>
							<th>Nama Dokter</th>
							<th>Opsi</th>

							<?php } ?>

							<?php
							if(!empty($_SESSION['farmasi']) OR !empty($_SESSION['admin']))
							{?>
							<th>Status Obat</th>
							<th>Opsi</th>

							<?php } ?>
							

						</thead>
					    <tbody>
					    <?php
					    $query=mysqli_query($koneksi, "SELECT per.*, pas.nama_pasien AS namapas, d.nama_dokter AS namdok FROM tb_pemeriksaan per, tb_pasien pas, tb_dokter d WHERE per.no_rm=pas.no_rm AND d.id_dokter=per.id_dokter ORDER BY tanggal_kunjungan DESC ");
					    $i=0;

					    while($res=mysqli_fetch_array($query))
					    {
					    	$i=$i+1; ?>
							<tr>
								<td><?php echo $res['id_periksa']; ?></td>
								<td><?php echo $res['namapas']; ?></td>

								<?php
								if(!empty($_SESSION['dokter'])  OR !empty(($_SESSION['pelaporan'])))
								{?>
								<td><?php echo $res['diagnosa']; ?></td>
								<td><?php echo $res['lab']; ?></td>
								<td><?php echo $res['tindakan']; ?></td>
								

								<?php }

								 ?>
								

								<td><?php echo $res['resep']; ?></td>
								<td><?php echo $res['tanggal_kunjungan']; ?></td>

								<?php
								if(!empty($_SESSION['dokter']))
								{?>
								<td><?php echo  $res['namdok'];?></td>
								<td>
									<button class="btn btn-primary btn-xs"  onclick="location.href='edit_rekammedis.php?id_rekam=<?php echo $res['id_periksa'];?>'">
									<i class="icon icon-edit"></i></button>
								</td>
								<!-- <td>
									<button class="btn btn-danger btn-xs" onclick="location.href='hapus_rekammedis.php?id_rekam=<?php echo $res['id_periksa'];?>'; return confirm('Anda yakin ingin menghapus data Rekam Medis <?php echo $res['namapas'];?> ?');">
										<i class="icon icon-trash"></i>
									</button>
								</td> -->
								<?php }

								 ?>

								<?php
								if(!empty($_SESSION['farmasi']) OR !empty($_SESSION['admin']))
								{?>
								<th><?php echo $res['sts_obat']; ?></th>
								<td>
									<?php
									if($res['sts_obat']=='Belum')
									{ ?>
									<button class="btn btn-primary btn-xs"  onclick="location.href='update_stsobat.php?id_periksa=<?php echo $res['id_periksa'];?>'">
									<i class="icon icon-check"></i>
									</button>	
									<?php }
									?>
									
								</td>

								<?php } ?>

								
							</tr>
					    <?php }
					    ?>
						</tbody>
			        </table> 
			        <?php 
			        if(!empty($_SESSION['pelaporan']))
			        { ?>
			        	<h4>Download Data Bulan :</h4>
			        	<form method="POST" action="cetak_lap_rm.php" class="col-md-4">
			        		<input type="month" name="bulan" class="form-control col-md-6" required>
				        	<input type="submit" name="donlot" value="Download" class="btn btn-primary btn-xs">
			        	</form> 
			        <?php }
			        ?>               
			    </div>
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

