<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Laporan Batik</title>
</head>
<body onload="window.print();">
<center>
<h1>Toko Batik Prima Sari</h1>
<h3>Laporan Data Batik</h3>
</center>
<table border="1" cellspacing="0" cellpadding="1" width="100%" align="center">
	<thead>
		<tr>
			<th>No</th>
			<th>Kode Batik</th>
			<th>Model Batik</th>
			<th>Motif Batik</th>
			<th>Daerah Asal</th>
			<th>Jenis Bahan</th>
			<th>Ukuran</th>
			<th>Kategori</th>
			<th>Berat</th>
			<th>Harga Grosir</th>
			<th>Min Grosir</th>
			<th>Harga Eceran</th>
		</tr>
	</thead>
	<tbody>
			<?php
			$n=1;
			$query="select * from tbl_batik order by model_batik asc";
			$res=$con->query($query);
			while ($data=$res->fetch_array(MYSQLI_BOTH)){
				?>
			<tr>	
				<td align="center"><?php echo $n; ?></td>
				<td align="center"><?php echo $data['id_batik']; ?></td>
				<td><?php echo $data['model_batik']; ?></td>
				<td align="center"><?php echo $data['motif_batik']; ?></td>
				<td align="center"><?php echo $data['daerah_asal']; ?></td>
				<td align="center"><?php echo $data['jenis_bahan']; ?></td>
				<td align="center"><?php echo $data['ukuran']; ?></td>
				<td align="center"><?php echo $data['kategori']; ?></td>
				<td align="center"><?php echo $data['berat']; ?></td>
				<td align="right">Rp.<?php echo number_format($data['harga_grosir'],0,".","."); ?></td>
				<td align="center"><?php echo $data['min_grosir']; ?></td>
				<td align="right">Rp.<?php echo number_format($data['harga_eceran'],0,".","."); ?></td>
				
			</tr>	
				<?php
				$n++;
			}
			?>
	</tbody>
</table>
</body>
</html>