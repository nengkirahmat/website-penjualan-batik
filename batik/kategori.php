<h3>Kategori <?php echo $_GET['kategori']; ?></h3>
<?php
				$kategori=$_GET['kategori'];
				$query="select * from tbl_batik where kategori='$kategori' order by id_batik desc";
				$query=$con->query($query);
			while ($res=$query->fetch_array(MYSQLI_BOTH)){
			?>
				<div class="body-artikel">
					<div class="img-artikel"><a href="index.php?aksi=page&page=detail&detail=<?php echo $res['id_batik']; ?>"><img style="max-height: 200px;" src="gambar/<?php echo $res['gambar']; ?>"/></a></div>
					<div class="caption-artikel">
						<h3><a href="index.php?aksi=page&page=detail&detail=<?php echo $res['id_batik']; ?>"><?php echo $res['model_batik']; ?></a></h3>
						<small>Grosir</small> <br><strong>Rp.<?php echo number_format($res['harga_grosir'],0,".","."); ?> </strong> <small>(Min. <?php echo $res['min_grosir']; ?> Pcs)</small><br>
						<small>Eceran</small> <strong>Rp.<?php echo number_format($res['harga_eceran'],0,".","."); ?> </strong><br>
						<small>Size</small> <strong><?php echo $res['ukuran']; ?></strong><br>
						<small>Kode</small> <strong><?php echo $res['id_batik']; ?></strong><br>
						<a class="btn-red" href="index.php?aksi=add&amp;id_batik=<?php echo $res['id_batik']; ?>">Beli</a>
					</div>
				</div>
			<?php } ?>