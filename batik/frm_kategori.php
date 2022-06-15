<?php
include "koneksi.php";

if (isset($_POST['simpan'])){
	$kategori=$_POST['kategori'];
	$query="insert into tbl_kategori values ('','$kategori')";
	$res=$con->query($query);
	if ($res){
		echo "Disimpan";
	}else{
		echo "Gagal Disimpan";
	}
}

if (!empty($_GET['action']) and $_GET['action']=="hapus_kategori" and !empty($_GET['id_kategori'])){
	$id_kategori=$_GET['id_kategori'];
	$query="delete from tbl_kategori where id_kategori='$id_kategori'";
	$res=$con->query($query);
	if ($res){
		header('location:index.php?aksi=page&page=data_kategori');
	}
}

?>
<?php if (!empty($_GET['page']) and $_GET['page']=="input_kategori"){ ?>
<h3>Input Data Kategori</h3>
<a class="btn-blue" href="index.php?aksi=page&amp;page=data_kategori">Data Kategori</a>
<br><br>
<form action="#" method="POST">
	<label>Kategori</label><br>
	<input type="text" name="kategori" required="" maxlength="30"><br>
	<input type="submit" name="simpan" value="Simpan">
</form>
<br><br>
<?php } ?>

<?php if (!empty($_GET['page']) and $_GET['page']=="data_kategori"){ ?>
<h3>Data Kategori</h3>
<a class="btn-blue" href="index.php?aksi=page&amp;page=input_kategori">Tambah Kategori</a>
<table border="1" cellspacing="0" cellpadding="1" width="98%">
	<thead>
		<tr>
			<th>No</th>
			<th>ID</th>
			<th>Kategori</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
			<?php
			$n=1;
			$query="select * from tbl_kategori order by id_kategori desc";
			$res=$con->query($query);
			while ($data=$res->fetch_array(MYSQLI_BOTH)){
				?>
			<tr>	
				<td align="center"><?php echo $n; ?></td>
				<td align="center"><?php echo $data['id_kategori']; ?></td>
				<td><?php echo $data['kategori']; ?></td>
				<td align="center"><a class="btn-red" href="frm_kategori.php?action=hapus_kategori&amp;id_kategori=<?php echo $data['id_kategori']; ?>">Hapus</a></td>
			</tr>	
				<?php
				$n++;
			}
			?>
	</tbody>
</table>
<br>
<?php } ?>