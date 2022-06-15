<style>
	small{
		padding: 10px;
		display: inline-block;
	}
</style>
<h3>Detail Batik</h3>
<?php
			if (!empty($_GET['detail'])){
				$id_batik=$_GET['detail'];
			$query="select * from tbl_batik where id_batik='$id_batik'";
			$query=$con->query($query);
			$res=$query->fetch_array(MYSQLI_BOTH);
			?>
				<div style="width: 100%;">
					<div class="img-artikel"><img src="gambar/<?php echo $res['gambar']; ?>"/>
					<h3>Keterangan</h3>
					<p><?php echo $res['keterangan']; ?></p>
					</div>
					<div class="caption-artikel">
						<h3 style="font-size: 20px;"><?php echo $res['model_batik']; ?></h3>
						<h4><?php echo $res['kategori']; ?></h4>
						<small>Kode</small> <strong><?php echo $res['id_batik']; ?></strong><br>
						<small>Harga Grosir</small> <strong>Rp.<?php echo number_format($res['harga_grosir'],0,".","."); ?> </strong> <small>(Min. <?php echo $res['min_grosir']; ?> Pcs)</small><br>
						<small>Eceran</small> <strong>Rp.<?php echo number_format($res['harga_eceran'],0,".","."); ?> </strong><br>
						<small>Berat</small> <strong><?php echo $res['berat']; ?></strong> Gram<br>
						<small>Size</small> <strong><?php echo $res['ukuran']; ?></strong><br>
						<small>Motif Batik</small> <strong><?php echo $res['motif_batik']; ?></strong><br>
						<small>Daerah Asal</small> <strong><?php echo $res['daerah_asal']; ?></strong><br>
						<small>Jenis Bahan</small> <strong><?php echo $res['jenis_bahan']; ?></strong><br>
						<a class="btn-red" href="index.php?aksi=add&amp;id_batik=<?php echo $res['id_batik']; ?>">Beli</a>
					</div>
				</div>
			<?php } ?>