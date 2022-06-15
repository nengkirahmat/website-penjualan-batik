<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Laporan Pembeli Batik</title>
</head>
<body onload="window.print();">
<center>
<h1>Toko Batik Prima Sari</h1>
<h3>Laporan Pembeli Batik</h3>
</center>
<table border="1" cellspacing="0" cellpadding="5" width="100%" align="center">
	<thead>
		<tr>
			<th>No</th>
			<th>Id Pembeli</th>
			<th>Nama Pembeli</th>
			<th>Alamat</th>
			<th>Kode Pos</th>
			<th>Telpon</th>
			<th>Email</th>
			<th>Id Transaksi</th>
		</tr>
	</thead>
	<tbody>
			<?php
			$n=1;
			$query="select * from tbl_pembeli,tbl_trans where tbl_trans.id_pembeli=tbl_pembeli.id_pembeli order by tbl_pembeli.nama_lengkap asc";
			$res=$con->query($query);
			while ($data=$res->fetch_array(MYSQLI_BOTH)){
				?>
			<tr>	
				<td align="center"><?php echo $n; ?></td>
				<td align="center"><?php echo $data['id_pembeli']; ?></td>
				<td><?php echo $data['nama_lengkap']; ?></td>
				<td><?php echo $data['alamat']; ?></td>
				<td align="center"><?php echo $data['pos']; ?></td>
				<td align="center"><?php echo $data['telp']; ?></td>
				<td><?php echo $data['email']; ?></td>
				<td><?php echo $data['id_trans']; ?></td>
			</tr>	
				<?php
				$n++;
			}
			?>
	</tbody>
</table>
<br>
</body>
</html>