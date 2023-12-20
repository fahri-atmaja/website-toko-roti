<?php
$cek="select max(kode_eoq) as maxKode from eoq";
$hasil	= mysql_query($cek);
$data	= mysql_fetch_array($hasil);
$kode = substr($data['maxKode'], 2, 8);
$tambah=$kode+1;
if($tambah<10){
		$kodekrs="Q00000".$tambah;
	} elseif($tambah<100) {
		$kodekrs="Q0000".$tambah;
	} elseif($tambah<1000) {
		$kodekrs="Q000".$tambah;
	} elseif($tambah<10000) {
	    $kodekrs="Q00".$tambah;
	} elseif($tambah<100000) {
	    $kodekrs="Q0".$tambah;
	} else {
	    $kodekrs="Q".$tambah;
	}
	?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title" style="padding-top:0; margin-top:0; color:#f00;">Tambah EOQ</h3>
			</div>
			<hr/>
			<div class="box-body">	
				<?php 
					if (isset($_POST['save'])) {
						$eoq->simpan_eoq($_POST['kode_eoq'],$_POST['nama_barang'],$_POST['periode'],$_POST['biaya_administrasi'],$_POST['lead_time']);
						echo "<script>bootbox.alert('Data Tersimpan', function(){
							window.location = 'index.php?page=eoq';
						});</script>";
					}
				?>	
				<form method="POST" id="forminput" enctype="multipart/form-data">
					<div class="form-group">
						<label>Kode EOQ</label>
						<input type="text" style="text-transform:uppercase" class="form-control" name="kode_eoq" id="kode_eoq" value="<?= $kodekrs ?>" maxlength="8" readonly>
						<div id="showresult" style="padding-top:4px; padding-bottom:0;"></div>
					</div>
					<div class="form-group">
						<label>Nama Barang</label>
						<select class="form-control" name="nama_barang" id="nama_barang">
						    <?php
						    $load = mysql_query("SELECT * FROM barang");
						    while ($row= mysql_fetch_array($load)) {
						        echo '<option name="nama_barang" value="' . $row['nama_barang'] . '">' . $row['nama_barang'] . '</option>';
						    }
						    ?>
						</select>
					</div>
					<div class="form-group">
						<label>Periode</label>
						<input type="text" name="periode" class="form-control" name="datepicker" id="datepicker" maxlength="7" readonly/>
					</div>
					<!--<div class="form-group">-->
					<!--	<label>Biaya Administrasi</label>-->
						<input type="hidden" class="form-control" name="biaya_administrasi" id="biaya_administrasi" value="25000">
					<!--</div>-->
					<!--<div class="form-group">-->
					<!--	<label>Lead Time</label>-->
						<input type="hidden" class="form-control" name="lead_time" id="lead_time" value="5">
					<!--</div>-->
					<button id="formbtn" class="btn btn-primary" name="save"><i class="fa fa-save"></i> Simpan</button>
					<a href="index.php?page=eoq" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Back to list eoq</a>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
//datepicker
$("#datepicker").datepicker( {
    format: "yyyy-mm",
    startView: "months", 
    minViewMode: "months"
});
	//upper
	$(function(){
		$('#kdbarang').focusout(function() {
        	// Uppercase-ize contents
        	this.value = this.value.toLocaleUpperCase();
    	});
    	$('#satuan').focusout(function() {
        	// Uppercase-ize contents
        	this.value = this.value.toLocaleUpperCase();
    	});
	});
	//fungsi hide div
	$(function(){
		setTimeout(function(){$("#divAlert").fadeOut(900)}, 500);
	});
	//ajax
	$(document).ready(function(){
		$('#kdbarang').blur(function(){
			var kdbarang = $(this).val();
			if (kdbarang == "") {
				$('#showresult').html("");
			}
			else{
				$.ajax({
					url: "validasi/cek-kdbarang.php?kdbarang="+kdbarang
				}).done(function(data){
					$('#showresult').html(data);
				});
			}
		});
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
	        var input = kdbarang.value;
			if (!validateText('kdbarang')) {
				$('#kdbarang').focus();
				return false;
			}
			else if (!(/^\S{0,}$/.test(input))) {
	           	$('#kdbarang').focus();
	           	bootbox.alert('Tidak Boleh Menggunakan Spasi');
	            return false;
	        }

			if (!validateText('nama')) {
				$('#nama').focus();
				return false;
			}
			if (!validateText('satuan')) {
				$('#satuan').focus();
				return false;
			}
			if (!validateText('hargaj')) {
				$('#hargaj').focus();
				return false;
			}
			if (!validateText('hargab')) {
				$('#hargab').focus();
				return false;
			}
			if (!validateText('stok')) {
				$('#stok').focus();
				return false;
			}
			return true;
		});
	});
</script>
