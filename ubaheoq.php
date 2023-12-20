<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title" style="padding-top:0; margin-top:0; color:#f00;">Ubah EOQ</h3>
			</div>
			<hr/>
			<div class="box-body">	
				<?php 
					if (isset($_POST['save'])) {
						$eoq->ubah_eoq($_POST['nama_barang'],$_POST['periode'],$_POST['biaya_administrasi']
							,$_POST['lead_time'],$_POST['kode_eoq']);
						echo "<script>bootbox.alert('Data Terubah', function(){
							window.location = 'index.php?page=eoq';
						});</script>";
					}
					$eo = $eoq->ambil_eoq($_GET['id']);
				?>	
				<form method="POST" id="forminput" enctype="multipart/form-data">
					<div class="form-group">
						<label>Kode EOQ</label>
						<input type="text" style="text-transform:uppercase" class="form-control" name="kode_eoq" id="kode_eoq" value="<?= $eo['kode_eoq'] ?>" readonly>
						<div id="showresult" style="padding-top:4px; padding-bottom:0;"></div>
					</div>
					<div class="form-group">
						<label>Nama Barang</label>
						<input type="text" style="text-transform:uppercase" class="form-control" name="nama_barang" id="nama_barang" value="<?= $eo['nama_barang'] ?>" readonly>
					</div>
					<div class="form-group">
						<label>Periode</label>
						<input type="text" name="periode" id="periode" class="form-control" name="datepicker" id="datepicker" maxlength="7" value="<?= $eo['periode'] ?>" readonly/>
					</div>
					<div class="form-group">
						<label>Biaya Administrasi</label>
						<input type="number" class="form-control" name="biaya_administrasi" id="biaya_administrasi" min="0" value="<?= $eo['biaya_administrasi'] ?>">
					</div>
					<div class="form-group">
						<label>Lead Time</label>
						<input type="number" class="form-control" name="lead_time" id="lead_time" min="0" value="<?= $eo['lead_time'] ?>">
					</div>
					<button id="formbtn" class="btn btn-primary" name="save"><i class="fa fa-save"></i> Simpan</button>
					<a href="index.php?page=eoq" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Back to list eoq</a>
				</form>
			</div>
			</div>
		</div>
	</div>
</div>
<script>
	//upper
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
			if (!validateText('nama_barang')) {
				$('#nama_barang').focus();
				return false;
			}
			if (!validateText('periode')) {
				$('#periode').focus();
				return false;
			}
			if (!validateText('biaya_administrasi')) {
				$('#biaya_administrasi').focus();
				return false;
			}
			if (!validateText('lead_time')) {
				$('#lead_time').focus();
				return false;
			}
			if (!validateText('kode_eoq')) {
				$('#kode_eoq').focus();
				return false;
			}
			return true;
		});
	});
</script>
