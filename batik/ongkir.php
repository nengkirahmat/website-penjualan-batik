<?php
if (isset($_POST['simpan_ongkir'])){
	$id_trans=$_POST['id_trans'];
	$berat=$_POST['berat'];
	$belanja=$_POST['belanja'];
	if ($_POST['ongkir']==""){
		$ongkir="Gratis";
	}else{
		$ongkir=$_POST['ongkir'];
	}
	$query="update tbl_trans set ongkir='$ongkir',total_berat='$berat',total_belanja='$belanja' where id_trans='$id_trans'";
	$res=$con->query($query);
	if ($res){
		header('location:index.php?aksi=page&page=keranjang_saya&id_trans='.$id_trans);
	}
}
?>
<h3>Penentuan Ongkos Kirim</h3>
<?php 
$id_trans=$_GET['id_trans'];
$query="select * from tbl_trans,tbl_pembeli where tbl_trans.id_trans='$id_trans' and tbl_trans.id_pembeli=tbl_pembeli.id_pembeli";
$res=$con->query($query);
$data=$res->fetch_array();
?>
<form action="#" method="POST">
	<input type="hidden" name="id_trans" value="<?php echo $id_trans; ?>">
	<?php if ($data['jenis_trans']=="Order Banyak"){
		?>
		Total Berat : <input type="text" name="berat" size="20" maxlength="10"> Gram<br><br>
		<?php
		}else{ ?>
	<input type="hidden" name="berat" value="<?php echo $data['total_berat']; ?>" size="20" maxlength="10">
	Total Berat : <?php echo $data['total_berat']; ?><br><br>
	<?php } ?>
	
	Jasa Pengiriman : <?php echo $data['jasa']; ?><br><br>
	Alamat Pengiriman : <?php echo $data['alamat']; ?><br><br>
	<?php if ($data['total_belanja']==0){
		?>
		Sub Total Belanja Rp.<input type="text" name="belanja" size="20" maxlength="10"><br><br>
		<?php
		}else{ ?>
	<input type="hidden" name="belanja" value="<?php echo $data['total_belanja']; ?>" size="20" maxlength="10">
	Sub Total Belanja Rp.<?php echo number_format($data['total_belanja'],0,".",'.'); ?><br><br>
	<?php } ?>
	Biaya Kirim : <input type="text" name="ongkir" size="30" maxlength="10"><small>(anda dapat mengosongkan Biaya Kirim apabila transaksi tidak dikenakan ongkos kirim / Gratis)</small><br><br>
	<input type="submit" class="btn-blue" name="simpan_ongkir" value="Simpan">
</form>