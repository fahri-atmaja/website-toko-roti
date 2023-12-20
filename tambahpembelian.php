<div class="row">
<?php 
    $time = date('d-m-Y  H:i:s');
	$kode = $pembelian->kode_otomatis();
	$subtotal = $pembelian->hitung_total_sementara($kode);
	$cekbarang = $pembelian->cek_data_barangp($kode);
	
	if (isset($_POST['tambah'])) {
		$pembelian->tambah_barang_sementara($kode,$_POST['nama'],$_POST['satuan'],$_POST['hargab'],$_POST['item']);
		echo "<script>location='index.php?page=tambahpembelian';</script>";
	}
	if (isset($_POST['save'])) {
	    $per = $perusahaan->tampil_perusahaan();
	    $tujuan = $per['email'];
	    $tam = $nota->ambil_nota_pembelian($_GET['kdpembelian']);
        $per = $perusahaan->tampil_perusahaan();
	    $mail = new PHPMailer;
    $mail->IsSMTP();
    $mail->SMTPSecure = ‘tls’;
    $mail->Host = "localhost"; //hostname masing-masing provider email
    $mail->SMTPDebug = 2;
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->Username = "fahri@webable.id"; //user email
    $mail->Password = "123asdqwe123"; //password email
    $mail->SetFrom("fahri@webable.id","INVENTORY APPS"); //set email pengirim
    $mail->Subject = "Pemberitahuan Email dari Website"; //subyek email
    $mail->AddAddress("$tujuan","OWNER NOTIFICATION"); //tujuan email
    $body .='<html>
        <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        	<title>INVENTORY APPS</title>
        </head>
        <body>
        	Notifikasi Pembelian <br>
        	Tanggal  : '. $_POST['tglpembelian'] .'<br>
        	Kode     : '. $_POST['kdpembelian'] .'<br>
        	Supplier : '. $_POST['supplier'] .'<br>
        	Subtotal : Rp '. $subtotal .'
            </body>
            </html>
                ';
    
    $mail->MsgHTML("$body");
    if($mail->Send()) echo "Message has been sent";
    else echo "Failed to sending message";
		$pembelian->simpan_pembelian($_POST['kdpembelian'],$_POST['tglpembelian'],$_POST['supplier'],$subtotal);
		$log -> simpan_log($_POST['kd_admin'],$_POST['deskripsi'],$_POST['waktu']);
		$pem = $pembelian->ambil_kdpem();
		$kodepem = $pem['kd_pembelian'];  
		echo "<script>
			bootbox.confirm('Lanjutkan Cetak Nota!', function(confirmed){
        	if (confirmed) {
        		window.location ='index.php?page=tambahpembelian';
        	  	window.open('nota/cetaknotapembelian.php?kdpembelian=$kodepem', '_blank');
        	}else{
        		window.location ='index.php?page=tambahpembelian';
        	}
        });
		</script>";
	}

	if (isset($_GET['hapusbs'])) {
		$pembelian->hapus_barang_sementara($_GET['hapusbs']);
		echo "<script>location='index.php?page=tambahpembelian';</script>";
	}
?>
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				Barang
			</div>
			<div class="panel-body">
				<form method="POST">
					<div class="form-group">
						<label>Nama Barang</label>
						<input type="text" class="form-control" name="nama" id="nama" placeholder="Masukan Nama Barang">
					</div>
					<div class="form-group">
						<label>Satuan</label>
						<input type="text" style="text-transform:uppercase" class="form-control" name="satuan" id="satuan" placeholder="Masukan Satuan" pattern="^[a-zA-Z]{1,100}$">
					</div>
					<div class="form-group">
						<label>Harga Beli</label>
						<input type="number" class="form-control" name="hargab" id="hargab" min="0">
					</div>
					<div class="form-group">
						<label>Jumlah Item</label>
						<input type="number" class="form-control" name="item" id="item" max="10000" min="0">
					</div>
					

			</div>
			<div class="panel-footer">
				<button class="btn btn-info" name="tambah" id="tambah"><i class="fa fa-plus"></i> Tambah</button>
			</div>
				</form>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				Transaksi Produksi
			</div>
			<div class="panel-body">
				<!--Form-->
				<form method="POST">
					<div class="form-group">
						<label>Kode Produksi</label>
						<input type="text" class="form-control" name="kdpembelian" id="kdpembelian" maxlength="8" readonly="true" value="<?php echo $kode; ?>">
					</div>
					<div class="form-group">
						<label>Tanggal Produksi</label>
						<input type="date" class="form-control" name="tglpembelian" id="tglpembelian">
					</div>
					<!-- log -->
					<input type="hidden" name="supplier" id="supplier" value="3">
					<input type="hidden" name="waktu" value="<?= $time ?>">
					<input type="hidden" name="deskripsi" value="Created Pembelian - Kode Pembelian : <?= $kode ?>">
					<input type="hidden" name="kd_admin" value="<?= $_SESSION['login_admin']['id'] ?>">
					<!-- end log -->
			</div>
		</div>
	</div>
	<div class="col-md-12">
		
		<div class="panel-footer" align="center">
		<?php if ($cekbarang === true): ?>
			<button id="formbtn" class="btn btn-primary" name="save"><i class="fa fa-save"></i> Simpan</button>
		<?php endif ?>
		<?php if ($cekbarang === false): ?>
			<button id="formbtn" class="btn btn-primary" name="save" disabled="disabled"><i class="fa fa-save"></i> Simpan</button>
		<?php endif ?>
		</div>				
				</form><!--End Form-->
	</div>
	<div class="col-md-12">
		<table class="table table-bordered table-responsive table-hover">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama Barang</th>
					<th>Satuan</th>
					<th>Harga</th>
					<th>Jumlah</th>
					<th>Total</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php  
					if ($cekbarang === false) {
						echo "<tr><td colspan='7' align='center'>Data saat ini kosong</td></tr>";
					}
					else{
					$br = $pembelian->tampil_barang_sementara($kode);
					foreach ($br as $index => $data) {
				?>
				<tr>
					<td><?php echo $index + 1; ?></td>
					<td><?php echo $data['nama_barangp']; ?></td>
					<td><?php echo $data['satuan']; ?></td>
					<td><?php echo rupiah($data['harga_barangp']); ?></td>
					<td><?php echo $data['item']; ?></td>
					<td><?php echo rupiah($data['total']); ?></td>
					<td>
						<a href="index.php?page=tambahpembelian&hapusbs=<?php echo $data['id_barangp']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Hapus</a>
					</td>
				</tr>
				<?php } }?>
				<tr class="active">
					<td colspan="5" align="center"><strong>Subtotal</strong></td>
					<td colspan="2"><?php echo rupiah($subtotal); ?></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<script>
	//upper
	$(function(){
    	$('#satuan').focusout(function() {
        	// Uppercase-ize contents
        	this.value = this.value.toLocaleUpperCase();
    	});
	});
	//fungsi hide div
	$(function(){
		setTimeout(function(){$("#divAlert").fadeOut(900)}, 500);
	});
	//validasi form
	function validateText(id){
		if ($('#'+id).val()== null || $('#'+id).val()== "") {
			var div = $('#'+id).closest('div');
			div.addClass("has-error has-feedback");
			return false;
		}
		else{
			var div = $('#'+id).closest('div');
			div.removeClass("has-error has-feedback");
			return true;	
		}
	}
	$(document).ready(function(){
		$("#formbtn").click(function(){
			if (!validateText('tglpembelian')) {
				$('#tglpembelian').focus();
				return false;
			}
			else if (!validateText('supplier')) {
				$('#supplier').focus();
				return false;
			}
			return true;
		});
	});
	$(document).ready(function(){
		$("#tambah").click(function(){
			if (!validateText('nama')) {
				$('#nama').focus();
				return false;
			}
			else if (!validateText('satuan')) {
				$('#satuan').focus();
				return false;
			}
			else if (!validateText('hargab')) {
				$('#hargab').focus();
				return false;
			}
			else if (!validateText('item')) {
				$('#item').focus();
				return false;
			}
			return true;
		});
	});
</script>