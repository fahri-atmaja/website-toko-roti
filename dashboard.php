<div class="row">
  <div class="col-md-12">
    <h2>DATA PENJUALAN</h2>   
    <h5>Welcome ... </h5>
  </div>
</div>
<hr />
<?php  
	$penjualan = $dashboard->penjualan_hariini();
	$pembelian = $dashboard->pembelian_hariini();
?>
<div class="row">
	<div class="col-md-6 col-sm-6 col-xs-6">           
		<div class="panel panel-back noti-box">
            <span class="icon-box bg-color-green set-icon">
                <i class="fa fa-money"></i>
            </span>
           	<div class="text-box" >
                <p class="main-text"><?php echo $penjualan; ?> New</p>
                <p class="text-muted">Penjualan Hari Ini</p>
            </div>
        </div>
		</div>
	<div class="col-md-6 col-sm-6 col-xs-6">           
		<div class="panel panel-back noti-box">
            <span class="icon-box bg-color-red set-icon">
                <i class="fa fa-download"></i>
            </span>
        	<div class="text-box" >
                <p class="main-text"><?php echo $pembelian; ?> New</p>
                <p class="text-muted">Produksi Hari Ini</p>
            </div>
        </div>
	</div>
</div>
        <div class="row">
	<div class="col-md-12">
		<h2>Diagram Barang Paling Laku</h2>
	</div>
	<br/><br/>
	<hr/>
	<br/>
</div>
<hr/>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
		    <div class="panel-body">
<?php

$qry = mysql_query("SELECT * FROM barang ORDER BY nama_barang ASC");
// while($data = mysql_fetch_array($qry)){
// 					$dem = $eoq->chart($data['nama_barang']);
// 					echo '"' . $dem['demand'] . '",';
// }
?>

 
	<div style="width: 800px;margin: 0px auto;">
		<canvas id="myChart"></canvas>
	</div>	
	<script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: [<?php while($data = mysql_fetch_array($qry)){
                                echo '"'.$data['nama_barang'].'",';   
                                } ?>],
				datasets: [{
					label: 'DEMAND',
					data: [
					<?php 
					$qry1 = mysql_query("SELECT * FROM barang ORDER BY nama_barang ASC");
					while($data = mysql_fetch_array($qry1)){
					$dem = $eoq->chart($data['nama_barang']);
					echo '"' . $dem['demand'] . '",';
					}
					?>
					],
					backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
				    'rgba(75, 192, 192, 0.2)',
				    'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
				    'rgba(75, 192, 192, 0.2)'
					],
					borderColor: [
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
				    'rgba(75, 192, 192, 1)',
				    'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
				    'rgba(75, 192, 192, 1)'
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>
        </div>
        </div>
        </div>
        </div>