<?php  

    if (isset($_POST['save'])) {
        // $barang->simpan_stok_gudang($_POST['kdbarang'],$_GET['kdbl'],$_POST['stok']);
        $kdbarang = $_POST['kdbarang'];
        $stok = $_POST['stok'];
        $kdbl = $_GET['kdbl'];
        mysql_query("UPDATE barang SET stok=stok+'$stok' WHERE kd_barang ='$kdbarang'");
		mysql_query("UPDATE barang_pembelian SET status='1' WHERE kd_barang_beli ='$kdbl'");
			echo "<script>alert('Data Berhasil Di Tambahkan!');
				window.location.href = 'index.php?page=barangpembelian';
				;</script>";
    }
    $nmbrg = $_GET['nmbrg'];
	$bel = $barang->ambil_barangpem($_GET['kdbl']);
	$brg1 = $barang->kode_barang($nmbrg);
?>
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title" style="padding-top:0; margin-top:0; color:#f00;">Simpan Barang Ke Gudang</h3>
			</div>
			<hr/>
			<div class="box-body">	
				<form method="POST" id="forminput" enctype="multipart/form-data">
					<div class="form-group">
						<label>Kode Barang</label>
						<!--<input type="text" class="form-control" name="kdbarang" id="kdbarang" maxlength="8" value="<?php echo $bel['nama_barang_beli']; ?>">-->
						<select class="form-control" name="kdbarang" id="kdbarang">
						    <?php
						    $load = mysql_query("SELECT * FROM barang WHERE nama_barang='$bel[nama_barang_beli]'");
						    while ($row= mysql_fetch_array($load)) {
				echo '<option name="kdbarang" value="' . $row['kd_barang'] . '">Kode:' . $row['kd_barang'] . '</option>';
				}
						    ?>
						</select>
					</div>
					<div class="form-group">
						<label>Tambahan Stok</label>
						<input type="text" class="form-control" name="stok" id="stok" readonly="true" value="<?php echo $bel['item']; ?>">
					</div>
					<button type="submit" class="btn btn-primary" name="save"><i class="fa fa-save"></i> Tambahkan Stok</button>
					<a href="index.php?page=barangpembelian" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Back to barang pembelian</a>
				</form>
			</div>
		</div>
	</div>
</div>
