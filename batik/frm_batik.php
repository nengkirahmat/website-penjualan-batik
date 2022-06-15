<?php
include "koneksi.php";

if (isset($_POST['simpan'])){
	$model=$_POST['model'];
	$kategori=$_POST['kategori'];
	$motif=$_POST['motif'];
	$daerah=$_POST['daerah'];
	$bahan=$_POST['bahan'];
	$ukuran=$_POST['ukuran'];
	$berat=$_POST['berat'];
	$grosir=$_POST['grosir'];
	$min=$_POST['min'];
	$eceran=$_POST['eceran'];
	$gambar=$_FILES['gambar']['name'];
	$keterangan=$_POST['keterangan'];
	$folder="gambar/";
	$folder=$folder.basename($_FILES['gambar']['name']);
	if (move_uploaded_file($_FILES['gambar']['tmp_name'], $folder)){
	$query="insert into tbl_batik values ('','$model','$kategori','$motif','$daerah','$bahan','$ukuran','$berat','$grosir','$min','$eceran','$gambar','$keterangan')";
	$res=$con->query($query);
	if ($res){
		echo "Disimpan";
	}else{
		echo "Gagal Disimpan";
	}
	}else{
		echo "Gagal Upload Gambar, Data Batik Tidak Disimpan";
	}
}

if (!empty($_GET['action']) and $_GET['action']=="hapus" and !empty($_GET['id_batik'])){
	$id_batik=$_GET['id_batik'];
	$query="delete from tbl_batik where id_batik='$id_batik'";
	$res=$con->query($query);
	if ($res){
		header('location:index.php?aksi=page&page=data_batik');
	}
}

?>

<?php if (!empty($_GET['page']) and $_GET['page']=="input_batik"){ ?>
<h3>Input Data Batik</h3>
<a class="btn-blue" href="index.php?aksi=page&amp;page=data_batik">Data Batik</a>
<br><br>
<form action="#" method="POST" enctype="multipart/form-data">
	<label>Model Batik</label><br>
	<input type="text" name="model" required="" size="50" maxlength="50"><br><br>
	<label>Kategori</label><br>
	<select style="padding: 5px;" name="kategori" required="">
		<option value="">--Kategori--</option>
		<?php
		$query="select * from tbl_kategori order by kategori asc";
		$kat=$con->query($query);
		while ($k=$kat->fetch_array(MYSQLI_BOTH)) {
			?>
			<option value="<?php echo $k['kategori']; ?>"><?php echo $k['kategori']; ?></option>
			<?php
		}
		?>
		<option value="Lainnya">Lainnya</option>
	</select><br><br>
	<label>Motif Batik</label><br>
	<input type="text" name="motif" required="" size="50" maxlength="30"><br><br>
	<label>Daerah Asal</label><br>
	<input type="text" name="daerah" required="" size="50" maxlength="50"><br><br>
	<label>Jenis Bahan</label><br>
	<select style="padding: 5px;" name="bahan" required="">
		<option value="">-- Jenis Bahan --</option>
		<option value="Katun">Katun</option>
		<option value="Katun">Balotelli</option>
		<option value="Katun">Embos</option>
	</select><br><br>
	<label>Ukuran</label><br>
	<select style="padding: 5px;" name="ukuran" required="">
		<option value="">-- Ukuran --</option>
		<option value="S">S</option>
		<option value="M">M</option>
		<option value="L">L</option>
		<option value="XL">XL</option>
		<option value="XXL">XXL</option>
		<option value="All Size">All Size</option>
	</select><br><br>
	<label>Berat</label><br>
	<input type="text" size="10" maxlength="10" name="berat"> Gram<br><br>
	<label>Harga Grosir</label><br>
	<input type="text" size="30" maxlength="10" name="grosir"><br><br>
	<label>Minimal Grosir</label><br>
	<input type="number" size="5" maxlength="10" name="min"><br><br>
	<label>Harga Eceran</label><br>
	<input type="text" size="30" maxlength="10" name="eceran"><br><br>
	<label>Upload Gambar</label><br>
	<input type="file" name="gambar" required=""><br><br>
	<label>Keterangan</label><br>
	<textarea name="keterangan" cols="50" rows="6"></textarea><br><br>
	<input type="submit" class="btn-blue" name="simpan" value="Simpan">
	<input type="reset" class="btn-red" value="Batal">
</form>
<br>
<?php } ?>


<?php if (!empty($_GET['page']) and $_GET['page']=="data_batik"){ ?>
<h3>Data Batik</h3>
<a class="btn-blue" href="index.php?aksi=page&amp;page=input_batik">Tambah Batik</a>
<table border="1" cellspacing="0" cellpadding="1" width="98%">
	<thead>
		<tr>
			<th>No</th>
			<th>Kode Batik</th>
			<th>Model Batik</th>
			<th>Kategori</th>
			<th>Berat</th>
			<th>Harga Grosir</th>
			<th>Min Grosir</th>
			<th>Harga Eceran</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
			<?php
			$n=1;
			$query="select * from tbl_batik order by id_batik desc";
			$res=$con->query($query);
			while ($data=$res->fetch_array(MYSQLI_BOTH)){
				?>
			<tr>	
				<td align="center"><?php echo $n; ?></td>
				<td align="center"><?php echo $data['id_batik']; ?></td>
				<td><?php echo $data['model_batik']; ?></td>
				<td align="center"><?php echo $data['kategori']; ?></td>
				<td align="center"><?php echo $data['berat']; ?></td>
				<td align="right">Rp.<?php echo number_format($data['harga_grosir'],0,".","."); ?></td>
				<td align="center"><?php echo $data['min_grosir']; ?></td>
				<td align="right">Rp.<?php echo number_format($data['harga_eceran'],0,".","."); ?></td>
				<td align="center"><a class="btn-red" href="frm_batik.php?action=hapus&amp;id_batik=<?php echo $data['id_batik']; ?>">Hapus</a></td>
			</tr>	
				<?php
				$n++;
			}
			?>
	</tbody>
</table>
<br>
<?php } ?>
