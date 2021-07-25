<?php
include "koneksi/koneksi.php";
session_start();

if (!empty($_SESSION['dokter']) OR !empty($_SESSION['farmasi'])OR !empty($_SESSION['admin']) OR !empty($_SESSION['pembayaran']) OR !empty($_SESSION['pendaftaran']) OR !empty($_SESSION['pelaporan']) OR !empty($_SESSION['perawat']) ) {
	if (!empty($_SESSION['dokter'])) {
		$dokter_terlogin = $_SESSION['dokter'];
		$sql = mysqli_query($koneksi,"SELECT * FROM tb_dokter WHERE id_dokter = '$dokter_terlogin'");

	}elseif (!empty($_SESSION['farmasi'])) 
	{
		$user_terlogin = $_SESSION['farmasi'];
		$bidang="Petugas Farmasi";$sql = mysqli_query($koneksi,"SELECT * FROM tb_user WHERE id_user= '$user_terlogin'");

	}elseif (!empty($_SESSION['perawat'])) 
	{
		$user_terlogin = $_SESSION['perawat'];
		$bidang="Petugas Perawat";$sql = mysqli_query($koneksi,"SELECT * FROM tb_user WHERE id_user= '$user_terlogin'");

	}elseif (!empty($_SESSION['pendaftaran'])) 
	{
		$user_terlogin = $_SESSION['pendaftaran'];
		$bidang="Petugas Pendaftaran";$sql = mysqli_query($koneksi,"SELECT * FROM tb_user WHERE id_user= '$user_terlogin'");

	}elseif (!empty($_SESSION['pelaporan']))
	 {
		$user_terlogin = $_SESSION['pelaporan'];
		$bidang="Petugas Pelaporan";$sql = mysqli_query($koneksi,"SELECT * FROM tb_user WHERE id_user= '$user_terlogin'");

	}elseif (!empty($_SESSION['admin']))
	 {
		$user_terlogin = $_SESSION['admin'];
		$bidang="Sys Admin";$sql = mysqli_query($koneksi,"SELECT * FROM tb_user WHERE id_user= '$user_terlogin'");

	}
	else
	{
		$user_terlogin = $_SESSION['pembayaran'];
		$bidang="Petugas Pembayaran";$sql = mysqli_query($koneksi,"SELECT * FROM tb_user WHERE id_user= '$user_terlogin'");

	}
	
}
else
{
	echo "<script> alert('Silahkan Login Terlebih Dahulu !!');
			window.location.href='Login%20form/login-page.php' </script>";
}


$data= mysqli_fetch_array($sql);

?>

<!DOCTYPE html>
<html class="no-js"> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Home</title>
	
	
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
		<!-- navbar -->
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
										<p><a href="#">	<?php echo  $data['id_dokter'];?>  </a></p>
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
					<!--Home-->
					<div class="col-xs-12 text-center">
						<div class="menu-1">
							<ul>
								<li class="active"><a href="home.php">Home</a></li>
								<li class="has-dropdown">
									<a href="#">Data</a>
									<ul class="dropdown">
										<!--petugas farmasi -->
										
										<?php
										if (!empty($_SESSION['farmasi'])) { ?>
										<li><a href="dataobat.php">Data Obat</a></li>
										<li><a href="datarekammedis.php">Rekam Medis</a></li>
										<!--petugas pendaftaran -->
										<?php 
										}elseif (!empty($_SESSION['pendaftaran'])){ ?>
										<li><a href="datapasien.php">Data Pasien</a></li>
										<!--dokter & perawat -->
										<?php 
										}elseif (!empty($_SESSION['dokter'])) { ?>
										<li><a href="datarekammedis.php">Rekam Medis</a></li>
										<li><a href="datapasien.php">Data Pasien</a></li>
										<!--petugas pelaporan -->
										<?php 
										}elseif (!empty($_SESSION['pelaporan'])) { ?>
										<li><a href="dataobat.php">Laporan Obat</a></li>
										<li><a href="datarekammedis.php">Laporan Rekam Medis</a></li>
										<li><a href="datapasien.php">Laporan Pasien</a></li>
										<li><a href="datapembayaran.php">Laporan Pembayaran</a></li>
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
										<li><a href="datapembayaran.php">Data Pembayaran</a></li>
										<?php }
										?>										
									</ul>
								</li>
								<li class="has-dropdown">
									<a href="#">Input</a>
									<ul class="dropdown">
										<?php
										if (!empty($_SESSION['farmasi'])) 
										{ ?>
										<li><a href="formobat.php">Input Obat</a></li>
										<!--petugas pendaftaran -->
										<?php 
										}elseif (!empty($_SESSION['pendaftaran'])) { ?>
										<li><a href="formpasien.php">Input Pasien</a></li>
										<!--dokter-->
										<?php 
										}elseif (!empty($_SESSION['dokter'])) { ?>
										<li><a href="formrekammedis.php">Rekam Medis</a></li>
										<li><a href="formrujukan.php">Rujukan</a></li>
										<!--admin-->
										<?php 
										}elseif (!empty($_SESSION['admin'])) { ?>
										<li><a href="formpasien.php">Input Pasien</a></li>
										<li><a href="formobat.php">Input Obat</a></li>
										<li><a href="formpembayaran.php">Input Pembayaran</a></li>
										
										<!--petugas pembayaran -->
										<?php 
										}else{ ?> 
										<li><a href="formpembayaran.php">Input Pembayaran</a></li>
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
	<!-- tabel data Pendaftaran-->
	<div class="container">
		<div class="row">
						<?php
						if (!empty($_SESSION['pendaftaran']) OR !empty($_SESSION['admin'])  OR !empty($_SESSION['pelaporan'])) 
						{ ?>
			<div class="col-md-12">
				<form action="" method="POST" class="appointment-wrap animate-box" id="formcari">
					<div class="row form-group">
						<div class="col-md-12">
							<label for="email">Cari Pasien</label>
							<input type="text" name="kunci" class="form-control" placeholder="Masukkan No RM atau Nama Pasien">
						</div>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-xs" name="cari" form="formcari">
							<i class="material-icons"></i> Cari
						</button>
						
						<button class="btn btn-primary btn-xs" onclick="location.href='datapasien.php">
							<i class="material-icons"></i> Refresh
						</button>
					</div>
				</form>
				
				<?php
                if(isset($_POST['cari']))
                {
                    $cari  = $_POST['kunci'];
				    $data  = mysqli_query($koneksi, "SELECT * FROM tb_pasien WHERE nama_pasien LIKE '%$cari%' OR no_rm LIKE '%$cari%' ");
				    // $res=$result;
				    ?>
			    <div class="table-responsive">
					<table class="table table-bordred table-striped">
			           <thead>
							
							<th>No. RM</th>
							<th>Tanggal Pendaftaran</th>
							<th>Nama</th>
							<th>Tanggal Lahir</th>
							<th>Alamat</th>
							<th>Telepon</th>
							<th>Jenis Kelamin</th>
							<th>Pekerjaan</th>
							<th>Status</th>
							<th>Nama Keluarga</th>
							<th>Cetak Kartu</th>
						</thead>
					    <tbody>
					    <?php
					    $i=0;
					    while($res=mysqli_fetch_array($data))
					    {
					    	$i=$i+1; ?>
							<tr>
								<td><?php echo $res['no_rm']; ?></td>
								<td><?php echo $res['tgl_daftar']; ?></td>
								<td><?php echo $res['nama_pasien']; ?></td>
								<td><?php echo $res['tgl_lahir_pasien']; ?></td>
								<td><?php echo $res['alamat_pasien']; ?></td>
								<td><?php echo $res['no_hp_pasien']; ?></td>
								<td><?php echo $res['jenis_kelamin']; ?></td>
								<td><?php echo $res['pekerjaan']; ?></td>
								<td><?php echo $res['status']; ?></td>
								<td><?php echo $res['nama_keluarga']; ?></td>
								 <td><button class="btn btn-primary btn-xs" onclick="location.href='cetak_kartu.php?id_pas=<?php echo $res['no_rm'];?>'"><i class="icon icon-tag"></i></button>
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
							<th>No. RM</th>
							<th>Tanggal Pendaftaran</th>
							<th>Nama</th>
							<th>Tanggal Lahir</th>
							<th>Alamat</th>
							<th>Telepon</th>
							<th>Jenis Kelamin</th>
							<th>Pekerjaan</th>
							<th>Status</th>
							<th>Nama Keluarga</th>
							<th>Cetak Kartu</th>
						</thead>
					    <tbody>
					    <?php
					    $query=mysqli_query($koneksi, "SELECT * FROM tb_pasien where tgl_daftar >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) ORDER BY tgl_daftar DESC");
					    $i=0;
					    while($res=mysqli_fetch_array($query))
					    {
					    	$i=$i+1; ?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $res['no_rm']; ?></td>
								<td><?php echo $res['tgl_daftar']; ?></td>
								<td><?php echo $res['nama_pasien']; ?></td>
								<td><?php echo $res['tgl_lahir_pasien']; ?></td>
								<td><?php echo $res['alamat_pasien']; ?></td>
								<td><?php echo $res['no_hp_pasien']; ?></td>
								<td><?php echo $res['jenis_kelamin']; ?></td>
								<td><?php echo $res['pekerjaan']; ?></td>
								<td><?php echo $res['status']; ?></td>
								<td><?php echo $res['nama_keluarga']; ?></td>
								 <td><button class="btn btn-primary btn-xs" onclick="location.href='cetak_kartu.php?id_pas=<?php echo $res['no_rm'];?>'"><i class="icon icon-tag"></i></button>
								</td>
							</tr>
					    <?php }
					    ?>
						</tbody>
			        </table>                
			    </div>
			    <?php } ?>
			</div>
			<?php } ?>
	<!-- tabel data  Dokter-->
	<div class="container">
		<div class="row">
						<?php
						if (!empty($_SESSION['dokter'])) 
						{ ?>
			<div class="col-md-12">
				<form action="" method="POST" class="appointment-wrap animate-box" id="formcari">
					<div class="row form-group">
						<div class="col-md-12">
							<label for="email">Cari Pasien</label>
							<input type="text" name="kunci" class="form-control" placeholder="Masukkan Nama Pasien atau No Pemeriksaan">
						</div>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-xs" name="cari" form="formcari">
							<i class="material-icons"></i> Cari
						</button>
						
						<button class="btn btn-primary btn-xs" onclick="location.href='datarekammedis.php">
							<i class="material-icons"></i> Refresh
						</button>
					</div>
				</form>
				
				<?php
                if(isset($_POST['cari']))
                {
                    $cari  = $_POST['kunci'];
				    $data  = mysqli_query($koneksi, "SELECT * FROM tb_pemeriksaan b, tb_pasien p  WHERE b.no_rm=p.no_rm AND (b.nama_pasien LIKE '%$cari%' OR b.id_periksa LIKE '%$cari%') ORDER BY tanggal_kunjungan DESC");
				    // $res=$result;
				    ?>
			    <div class="table-responsive">
					<table class="table table-bordred table-striped">
			           <thead>
							
							<th>No. Pemeriksaan</th>
							<th>Nama Pasien</th>
							<th>Diagnosa</th>
							<th>Lab</th>
							<th>Tindakan</th>
							<th>Resep</th>
							<th>Tanggal Periksa</th>
							<th>Nama Keluarga</th>
							<th>Cetak Hasil Pemeriksaan</th>

						</thead>
					    <tbody>
					    <?php
					    $i=0;
					    while($res=mysqli_fetch_array($data))
					    {
					    	$i=$i+1; ?>
							<tr>
								<td><?php echo $res['id_periksa']; ?></td>
								<td><?php echo $res['nama_pasien']; ?></td>
								<td><?php echo $res['diagnosa']; ?></td>
								<td><?php echo $res['lab']; ?></td>
								<td><?php echo $res['tindakan']; ?></td>
								<td><?php echo $res['resep']; ?></td>
								<td><?php echo $res['tanggal_kunjungan']; ?></td>
								<td><?php echo $res['nama_keluarga']; ?></td>
								<td><button class="btn btn-primary btn-xs" onclick="location.href='cetak.php?id_pas=<?php echo $res['id_periksa'];?>'"><i class="icon icon-tag"></i></button>
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
							<th>No. Pemeriksaan</th>
							<th>Nama Pasien</th>
							<th>Diagnosa</th>
							<th>Lab</th>
							<th>Tindakan</th>
							<th>Resep</th>
							<th>Tanggal Periksa</th>
						</thead>
					    <tbody>
					    <?php
					    $query=mysqli_query($koneksi, "SELECT * FROM tb_pemeriksaan where tanggal_kunjungan >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) ORDER BY tanggal_kunjungan DESC");
					    $i=0;
					    while($res=mysqli_fetch_array($query))
					    {
					    	$i=$i+1; ?>
							<tr>
								<td><?php echo $i; ?></td>
							<td><?php echo $res['id_periksa']; ?></td>
								<td><?php echo $res['nama_pasien']; ?></td>
								<td><?php echo $res['diagnosa']; ?></td>
								<td><?php echo $res['lab']; ?></td>
								<td><?php echo $res['tindakan']; ?></td>
								<td><?php echo $res['resep']; ?></td>
								<td><?php echo $res['tanggal_kunjungan']; ?></td>
								<td><button class="btn btn-primary btn-xs" onclick="location.href='cetak.php?id_pas=<?php echo $res['id_periksa'];?>'"><i class="icon icon-tag"></i></button>
							</tr>
					    <?php }
					    ?>
						</tbody>
			        </table>                
			    </div>
			    <?php } ?>
			</div>
			<?php } ?>

	<!-- tabel data  Farmasi/Admin-->
	<div class="container">
		<div class="row">
						<?php
						if (!empty($_SESSION['farmasi'])) 
						{ ?>
			<div class="col-md-12">
				<form action="" method="POST" class="appointment-wrap animate-box" id="formcari">
					<div class="row form-group">
						<div class="col-md-12">
							<label for="email">Cari Draft Obat Pasien</label>
							<input type="text" name="kunci" class="form-control" placeholder="Masukkan Nama Pasien atau No Pemeriksaan">
						</div>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-xs" name="cari" form="formcari">
							<i class="material-icons"></i> Cari
						</button>
						<button class="btn btn-primary btn-xs" onclick="location.href='datarekammedis.php">
							<i class="material-icons"></i> Refresh
						</button>
					</div>
				</form>
				
				<?php
                if(isset($_POST['cari']))
                {
                    $cari  = $_POST['kunci'];
				    $data  = mysqli_query($koneksi, "SELECT * FROM tb_pemeriksaan WHERE nama_pasien LIKE '%$cari%' OR id_periksa LIKE '%$cari%'");
				    // $res=$result;
				    ?>
			    <div class="table-responsive">
					<table class="table table-bordred table-striped">
			           <thead>
							
							<th>No. Pemeriksaan</th>
							<th>Nama Pasien</th>
							<th>Resep</th>
							<th>Tanggal Periksa</th>
							<th>Status Obat</th>

						</thead>
					    <tbody>
					    <?php
					    $i=0;
					    while($res=mysqli_fetch_array($data))
					    {
					    	$i=$i+1; ?>
							<tr>
								<td><?php echo $res['id_periksa']; ?></td>
								<td><?php echo $res['nama_pasien']; ?></td>
								<td><?php echo $res['resep']; ?></td>
								<td><?php echo $res['tanggal_kunjungan']; ?></td>
								<th><?php echo $res['sts_obat']; ?></th>
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
							<th>No. Pemeriksaan</th>
							<th>Nama Pasien</th>
							<th>Resep</th>
							<th>Tanggal Periksa</th>
							<th>Status Obat</th>
						</thead>
					    <tbody>
					    <?php
					    $query=mysqli_query($koneksi, "SELECT * FROM tb_pemeriksaan where tanggal_kunjungan >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) ORDER BY tanggal_kunjungan DESC");
					    $i=0;
					    while($res=mysqli_fetch_array($query))
					    {
					    	$i=$i+1; ?>
							<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $res['id_periksa']; ?></td>
								<td><?php echo $res['nama_pasien']; ?></td>
								<td><?php echo $res['resep']; ?></td>
								<td><?php echo $res['tanggal_kunjungan']; ?></td>
								<th><?php echo $res['sts_obat']; ?></th>
							</tr>
					    <?php }
					    ?>
						</tbody>
			        </table>                
			    </div>
			    <?php } ?>
			</div>
			<?php } ?>
	
	<!-- tabel data  Pembayaran/Admin-->
	<div class="container">
		<div class="row">
						<?php
						if (!empty($_SESSION['pembayaran'])) 
						{ ?>
			<div class="col-md-12">
				<form action="" method="POST" class="appointment-wrap animate-box" id="formcari">
					<div class="row form-group">
						<div class="col-md-12">
							<label for="email">Cari Data Pembayaran</label>
							<input type="text" name="kunci" class="form-control" placeholder="Masukkan Nama Pasien atau No Pemeriksaan">
						</div>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-xs" name="cari" form="formcari">
							<i class="material-icons"></i> Cari
						</button>
						
						<button class="btn btn-primary btn-xs" onclick="location.href='datapembayaran.php">
							<i class="material-icons"></i> Refresh
						</button>
					</div>
				</form>
				
				<?php
                if(isset($_POST['cari']))
                {
                    $cari  = $_POST['kunci'];
				    $data  = mysqli_query($koneksi, "SELECT * FROM tb_bayar b, tb_pasien p WHERE b.no_rm=p.no_rm AND (p.nama_pasien LIKE '%$cari%' OR b.no_rm LIKE '%$cari%') ORDER BY tgl_bayar DESC");
				    // $res=$result;
				    ?>
			    <div class="table-responsive">
					<table class="table table-bordred table-striped">
			           <thead>
							<th>No.</th>
							<th>No. RM</th>
							<th>Nomor Pemeriksaan</th>
							<th>Tanggal Pembayaran</th>
							<th>Nama</th>
							<th>Biaya Diagnosa</th>
							<th>Biaya Tindakan</th>
							<th>Biaya Resep</th>
							<th>Total</th>
						</thead>
					    <tbody>
					    <?php
					    $i=0;
					    while($res=mysqli_fetch_array($data))
					    {
					    	$i=$i+1; ?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $res['no_rm']; ?></td>
								<td><?php echo $res['id_periksa']; ?></td>
								<td><?php echo $res['tgl_bayar']; ?></td>
								<td><?php echo $res['nama_pasien']; ?></td>
								<td><?php echo $res['b_diagnosa']; ?></td>
								<td><?php echo $res['b_tindakan']; ?></td>
								<td><?php echo $res['b_resep']; ?></td>
								<td><?php echo $res['jumlah_bayar']; ?></td>
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
							<th>No. RM</th>
							<th>Nomor Pemeriksaan</th>
							<th>Tanggal Pembayaran</th>
							<th>Nama</th>
							<th>Biaya Diagnosa</th>
							<th>Biaya Tindakan</th>
							<th>Biaya Resep</th>
							<th>Total</th>
						</thead>
					    <tbody>
					    <?php
					    $query=mysqli_query($koneksi, "SELECT * FROM tb_bayar b, tb_pasien p WHERE b.no_rm=p.no_rm ORDER BY tgl_bayar DESC");
					    $i=0;
					    while($res=mysqli_fetch_array($query))
					    {
					    	$i=$i+1; ?>
							<tr>
							<td><?php echo $i; ?></td>
								<td><?php echo $res['no_rm']; ?></td>
								<td><?php echo $res['id_periksa']; ?></td>
								<td><?php echo $res['tgl_bayar']; ?></td>
								<td><?php echo $res['nama_pasien']; ?></td>
								<td><?php echo $res['b_diagnosa']; ?></td>
								<td><?php echo $res['b_tindakan']; ?></td>
								<td><?php echo $res['b_resep']; ?></td>
								<td><?php echo $res['jumlah_bayar']; ?></td>
							</tr>
					    <?php }
					    ?>
						</tbody>
			        </table>                
			    </div>
			    <?php } ?>
			</div>
			<?php } ?>
	
		
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

