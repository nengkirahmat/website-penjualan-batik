<?php
include "koneksi.php";

if (!empty($_GET['action']) and $_GET['action']=="status_bayar" and !empty($_GET['id_trans'])){
	$id_trans=$_GET['id_trans'];
	$query="update tbl_trans set status_bayar='Dibayar' where id_trans='$id_trans'";
	$res=$con->query($query);
	if ($res){
		header('location:index.php?aksi=page&page=data_pembayaran');
	}
}

if (!empty($_GET['action']) and $_GET['action']=="hapus_bayar" and !empty($_GET['id_bayar'])){
	$id_bayar=$_GET['id_bayar'];
	$query="delete from tbl_bayar where id_bayar='$id_bayar'";
	$res=$con->query($query);
	if ($res){
		header('location:index.php?aksi=page&page=data_pembayaran');
	}
}
?>
<h3>Data Pembayaran</h3>
<?php
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
		<td align="center"><a href="index.php?aksi=page&page=keranjang_saya&id_trans=<?php echo $data['id_trans']; ?>"><?php echo $data['id_trans']; ?></a></td>
		<td><?php echo $data['nama_rek']; ?></td>
		<td align="center"><?php echo $data['no_rek']; ?></td>
		<td align="center"><?php echo $data['bank']; ?></td>
		<td align="right"><?php echo number_format($data['jumlah'],0,".","."); ?></td>
		<td align="center"><a class="btn-green" href="index.php?aksi=page&page=keranjang_saya&id_trans=<?php echo $data['id_trans']; ?>">Lihat Trans</a> 
		<?php
		$id_trans=$data['id_trans'];
		$query="select * from tbl_trans where id_trans='$id_trans'";
		$status=$con->query($query);
		$st=$status->fetch_array();
		if ($st['status_bayar']<>"Dibayar"){ ?>
		<a class="btn-blue" href="tbl_pembayaran.php?action=status_bayar&amp;id_trans=<?php echo $data['id_trans']; ?>">Setujui</a>
		<a class="btn-red" href="tbl_pembayaran.php?action=hapus_bayar&amp;id_bayar=<?php echo $data['id_bayar']; ?>">Hapus</a>
		<?php }else{ echo " Telah Disetujui"; } ?>
		</td>
	</tr>
	<?php $n++; } ?>
</table>