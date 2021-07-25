<?php
include "koneksi/koneksi.php";
$sql = mysqli_query($koneksi,"SELECT * FROM tb_user");
$data= mysqli_fetch_array($sql);
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<style type="text/css">
	body{
		font-family: sans-serif;
	}
	table{
		margin: 20px auto;
		border-collapse: collapse;
	}
	table th,
	table td{
		border: 1px solid #3c3c3c;
		padding: 3px 8px;
 
	}
	a{
		background: blue;
		color: #fff;
		padding: 8px 10px;
		text-decoration: none;
		border-radius: 2px;
	}
	</style>
 
	
 
	<center>
		<h1>Data Obat</h1>
	</center>
 
	<table border="1">
		<tr>
			<th>No.</th>
							<th>Nama Obat</th>
							<th>Jenis</th>
							<th>Harga</th>
							<th>Jumlah</th>
		</tr>
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
								<td><?php echo $res['harga_obat']; ?></td>
								<td><?php echo $res['jumlah_obat']; ?></td>
								</tr>

					    <?php }
					    ?>
	</table>
	<script>
		window.print();
	</script>
</body>
</html>