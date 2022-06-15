<!DOCTYPE html>
<html>
<head>
	<title>Laporan Pembayaran Transaksi Batik</title>
</head>
<body>
<center>
<h1>Toko Batik Prima Sari</h1>
<h3>Laporan Pembayaran Transaksi Batik</h3>
</center>
<?php
include "koneksi.php";
$query="select * from tbl_bayar order by id_bayar desc";
$res=$con->query($query);

?>
<table border="1" cellspacing="0" cellpadding="5" width="100%">
	<tr>
		<th>No</th>
		<th>Id Trans</th>
		<th>Nama Rekening</th>
		<th>Nomor Rekening</th>
		<th>Bank</th>
		<th>Jumlah</th>
		<th>Action</th>
	</tr>
	<?php $n=1; while ($data=$res->fetch_array(MYSQLI_BOTH)){ ?>
	<tr>
		<td align="center"><?php echo $n; ?></td>
		<td align="center"><?php echo $data['id_trans']; ?></td>
		<td><?php echo $data['nama_rek']; ?></td>
		<td align="center"><?php echo $data['no_rek']; ?></td>
		<td align="center"><?php echo $data['bank']; ?></td>
		<td align="right"><?php echo number_format($data['jumlah'],0,".","."); ?></td>
		<td align="center"> 
		<?php
		$id_trans=$data['id_trans'];
		$query="select * from tbl_trans where id_trans='$id_trans'";
		$status=$con->query($query);
		$st=$status->fetch_array();
		if ($st['status_bayar']=="Dibayar"){  echo "Disetujui"; } ?>
		</td>
	</tr>
	<?php $n++; } ?>
</table>
</body>
</html>