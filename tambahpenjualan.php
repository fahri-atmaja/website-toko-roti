<?php 
	$kode = $penjualan->kode_otomatis();
	$subtotal = $penjualan->hitung_total_sementara($kode);
	$cekbarang = $penjualan->cek_data_barangp($kode);
	$per = $perusahaan->tampil_perusahaan();
	            $tujuan = $per['email'];
	$time = date('d-m-Y  H:i:s');
	
	if (isset($_POST['tambah'])) {
		$cekitem = $penjualan->cek_item($_GET['proses'],$_POST['item']);
		if ($cekitem === true) {
			$penjualan->tambah_penjualan_sementara($kode,$_GET['proses'],$_POST['item']);

			echo "<script>location='index.php?page=tambahpenjualan';</script>";
		}
	}
	if (isset($_POST['save'])) {
	    $kdpen = $_POST['kdpenjualan'];
	    $bar = $penjualan->tampil_barang_sementara($kode);
	    $jmk = "300";
	    $lt = "4";
	    $bp = "100000";
	    
	    
					foreach ($bar as $index => $data) {
	            $kdbrg = $data['kd_barang'];
	            $nmbrg = $data['nama_barang'];
	            $cekdemand = mysql_query("SELECT SUM(item) as demand FROM barang_pembelian
	                                        INNER JOIN pembelian ON pembelian.kd_pembelian=barang_pembelian.kd_pembelian
	                                        WHERE barang_pembelian.nama_barang_beli='$nmbrg' AND (pembelian.tgl_pembelian BETWEEN '2022-05-01' AND '2022-05-30')");
	            $arr = mysql_fetch_array($cekdemand);
	            $demand = $arr['demand'];
	            $bar2 = $barang->ambil_barang($kdbrg);
	            $jumitem = $bar2['stok'];
	            $hrg_beli = $bar2['harga_beli'];
	            $jumlah = 2*$hrg_beli*$demand/(25/100*$hrg_beli);
	            $eoq = sqrt($jumlah);
			}
                
		if ($_POST['totalbayar'] < $subtotal ) {
			echo "<script>bootbox.alert('Total Bayar Tidak Cukup!', function(){

			});</script>";
		}else{
		    if($jumitem < 100){
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
                $mail->Subject = "Peringatan Stock Barang"; //subyek email
                $mail->AddAddress("$tujuan","OWNER NOTIFICATION"); //tujuan email
                $body .='<html>
                    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                    	<title>INVENTORY APPS</title>
                    </head>
                    <body>
                    	Notifikasi Peringatan Stok Barang<br>
                    	Kode Brg    :  '.$kdbrg.'<br>
                    	Nama Brg    :  '.$nmbrg.'<br>
                    	Biaya Pesan :  '.$hrg_beli.'<br>
                    	Stok        :  '.$jumitem.'
                        </body>
                        </html>
                            ';
                
                $mail->MsgHTML("$body");
                if($mail->Send()) echo "Message has been sent";
                else echo "Failed to sending message";
		    }
			$penjualan->simpan_penjualan($_POST['kdpenjualan'],$_POST['tglpenjualan'],$_POST['totalbayar'],$subtotal);
			$log -> simpan_log($_POST['kd_admin'],$_POST['deskripsi'],$_POST['waktu']);
			$pen = $penjualan->ambil_kdpen();
			$kodepen = $pen['kd_penjualan'];
			$kem = $_POST['totalbayar'] - $subtotal;
			$kembalian = rupiah($kem);
			echo "<script>
				bootbox.confirm('Notifikasi Peringatan Stok Barang Kode Brg    :  $kdbrg Nama Brg    :  $nmbrg Biaya Pesan :  $hrg_beli Stok        :  $jumitem Demand      :  $demand EOQ         : $eoq Kembalian Rp. $kembalian, Lanjutkan Cetak Nota!', function(confirmed){
	        	if (confirmed) {
	        		window.location ='index.php?page=tambahpenjualan';
	        	  	window.open('nota/cetaknotapenjualan.php?kdpenjualan=$kodepen', '_blank');
	        	}else{
	        		window.location ='index.php?page=tambahpenjualan';
	        	}
	        });
			</script>";
		}
		
	}
	if (isset($_GET['hapus'])) {
		$penjualan->hapus_penjualan_sementara($_GET['hapus']);
		echo "<script>location='index.php?page=tambahpenjualan';</script>";
	}
	$kdbar = "";
	$namabr = "";
	if (isset($_GET['proses'])) {
		$bar = $barang->ambil_barang($_GET['proses']);
		$namabr = $bar['nama_barang'];
		$kdbar = $_GET['proses'];
	}
?>
<div class="row">
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				Barang
			</div>
			<div class="panel-body">
				<form method="POST">
					<div class="form-group">
						<label>Kd Barang</label>
						<input type="text" class="form-control" id="kdbarang" name="kdbarang" disabled="disabled" value="<?php echo $kdbar; ?>">
					</div>
					<div class="form-group">
						<label>Nama Barang</label>
						<input type="text" class="form-control" disabled="disabled" value="<?php echo $namabr;?>">
					</div>
					<div class="form-group">
						<label>Jumlah Item</label>
						<input type="number" class="form-control" name="item" id="item" max="10000" min="0">
						
					</div>

			</div>
			<div class="panel-footer">
			<?php if ($kdbar === ""): ?>				
				<button class="btn btn-info" name="tambah" id="tambah" disabled="disabled"><i class="fa fa-plus"></i> Tambah</button>
			<?php endif ?>
			<?php if ($kdbar !== ""): ?>
				<button class="btn btn-info" name="tambah" id="tambah"><i class="fa fa-plus"></i> Tambah</button>
			<?php endif ?>
			</div>
				</form>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				Penjualan
			</div>
			<div class="panel-body">
				<!--Form-->
				<form method="POST">
					<div class="form-group">
						<label>Kode Penjualan</label>
						<input type="text" class="form-control" name="kdpenjualan" id="kdpenjualan" maxlength="8" readonly="true" value="<?php echo $kode; ?>">
					</div>
					<div class="form-group">
						<label>Tanggal Penjualan</label>
						<input type="date" class="form-control" name="tglpenjualan" id="tglpenjualan">
					</div>
					<div class="form-group">
						<label>Total Bayar</label>
						<input type="number" class="form-control" name="totalbayar" id="totalbayar">
						
					</div>
					<!-- log -->
					<input type="hidden" name="waktu" value="<?= $time ?>">
					<input type="hidden" name="deskripsi" value="Created Penjualan - Kode Penjualan : <?= $kode ?>">
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
					$br = $penjualan->tampil_barang_sementara($kode);
					foreach ($br as $index => $data) {
				?>
				<tr>
					<td><?php echo $index + 1; ?></td>
					<td><?php echo $data['nama_barang']; ?></td>
					<td><?php echo $data['satuan']; ?></td>
					<td><?php echo rupiah($data['harga']); ?></td>
					<td><?php echo $data['item']; ?></td>
					<td><?php echo rupiah($data['total']); ?></td>
					<td>
						<a href="index.php?page=tambahpenjualan&hapus=<?php echo $data['id_penjualan_sementara']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Hapus</a>
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
<!--data barangnya-->
<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading">
                Data Barang
            </div>
            <div class="panel-body">
                <div class="table">
                    <table class="table table-striped table-bordered table-hover" id="tabelku">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Nama</th>
                                <th>Satuan</th>
                                <th>Harga Jual</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  
                                $brg = $penjualan->tampil_barang_penjualan();
                                foreach ($brg as $index => $data) {
                            ?>
                            <tr class="odd gradeX">
                                <td><?php echo $index + 1; ?></td>
                                <td><?php echo $data['kd_barang']; ?></td>
                                <td><?php echo $data['nama_barang']; ?></td>
                                <td><?php echo $data['satuan']; ?></td>
                                <td><?php echo rupiah($data['harga_jual']); ?></td>
                                <td>
                                    <a href="index.php?page=tambahpenjualan&proses=<?php echo $data['kd_barang']; ?>" class="btn btn-success btn-xs"><i class="fa fa-download"></i> Prosess</a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>   
            </div>
        </div>
        <!--End Advanced Tables -->
    </div>
</div>
<?php  
	if (isset($_GET['proses'])) {
		echo "<script>
			$('#item').focus();
		</script>";
	}
?>
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
			if (!validateText('tglpenjualan')) {
				$('#tglpenjualan').focus();
				return false;
			}
			else if (!validateText('totalbayar')) {
				$('#totalbayar').focus();
				return false;
			}
			return true;
		});
	});
	$(document).ready(function(){
		$("#tambah").click(function(){
			if (!validateText('item')) {
				$('#item').focus();
				return false;
			}
			return true;
		});
	});
</script>