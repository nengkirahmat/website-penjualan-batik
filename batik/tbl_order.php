<?php
include "koneksi.php";

if (!empty($_GET['action']) and $_GET['action']=="status_bayar" and !empty($_GET['id_trans'])){
	$id_trans=$_GET['id_trans'];
	$query="update tbl_trans set status_bayar='Dibayar' where id_trans='$id_trans'";
	$res=$con->query($query);
	if ($res){
		header('location:index.php?aksi=page&page=data_order');
	}
}
?>

<h3>Data Orderan</h3>
			<?php
			$query="select * from tbl_pembeli,tbl_trans where tbl_pembeli.id_pembeli=tbl_trans.id_pembeli and tbl_trans.jenis_trans='Keranjang' order by id_trans DESC";
			$res=$con->query($query);
			while ($data=$res->fetch_array(MYSQLI_BOTH)){
				?>
		<table border="1" cellspacing="0" cellpadding="5" width="98%">	
				<tr><td width="30%">ID Transaksi</td><td><?php echo $data['id_trans']; ?></td></tr>
				<tr><td>Nama Lengkap</td><td><?php echo $data['nama_lengkap']; ?></td></tr>
				<tr><td>Telpon / HP</td><td><?php echo $data['telp']; ?></td></tr>
				<tr><td>Alamat Lengkap</td><td><?php echo $data['alamat']; ?></td></tr>
				<tr><td>Jasa Pengiriman</td><td><?php echo $data['jasa']; ?></td></tr>
				<tr><td>Total Berat</td><td><?php echo $data['total_berat']; ?> Gram</td></tr>
				<tr><td>Ongkos Kirim</td><td><?php if ($data['ongkir']=="Gratis" or $data['ongkir']==""){ echo $data['ongkir']; }else { echo "Rp.".number_format($data['ongkir'],0,",","."); } ?></td></tr>
				<tr><td>Total Harga</td><td><?php echo "Rp.".number_format($data['total_belanja'],0,".","."); ?></td></tr>
				<tr><td>Total Belanja</td><td><?php if ($data['ongkir']<>"Gratis" or $data['ongkir']<>""){ echo "Rp.".number_format($data['total_belanja']+$data['ongkir'],0,".","."); }else{ echo number_format($data['total_belanja'],0,".","."); } ?></td></tr>
				<tr><td>Pembayaran</td><td><?php echo $data['pembayaran']; ?></td></tr>
				<tr><td>Status Bayar</td><td><?php echo $data['status_bayar']; ?></td></tr>
				<tr><td colspan="2">
				
				<?php if ($data['ongkir']=="0"){ ?>
				<a class="btn-green" href="index.php?aksi=page&amp;page=ongkir&amp;id_trans=<?php echo $data['id_trans']; ?>">Ongkir</a>
				<?php }else{ 
					if ($data['status_bayar']<>"Dibayar"){ ?>
				<a class="btn-red" href="tbl_order.php?action=status_bayar&amp;id_trans=<?php echo $data['id_trans']; ?>">Sudah Dibayar</a>
				<?php } } ?>

				<a class="btn-blue" href="index.php?aksi=page&amp;page=keranjang_saya&amp;id_trans=<?php echo $data['id_trans']; ?>">Lihat Keranjang</a>
				</td></tr>
				
			</table>
<br>
				<?php
			}
			?>
