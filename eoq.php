<?php  
    if (isset($_GET['hapus'])) {
        $eoq->hapus_eoq($_GET['hapus']);
        echo "<script>location='index.php?page=eoq';</script>";
    }
?>
<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading">
                Data EOQ
            </div>
            <div class="panel-body">
                <div class="table">
                    <table class="table table-striped table-bordered table-hover" id="tabelku">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Nama</th>
                                <th>Periode</th>
                                <th>Demand</th>
                                <th>EOQ</th>
                                <th>Safety Stock</th>
                                <th>Reorder Point</th>
                                <th>Max Inventory</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  
                                $eo = $eoq->tampil_eoq();
                                foreach ($eo as $index => $data) {
                            ?>
                            <tr>
                                <td><?php echo $index + 1; ?></td>
                                <td><?php echo $data['kode_eoq']; ?></td>
                                <td><?php echo $data['nama_barang']; ?></td>
                                <td><?php echo $data['periode']; ?></td>
                                <td><?php $dem = $eoq->hitung_eoq($data['nama_barang'],$data['periode']);
                                echo $dem['demand']; ?></td>
                                <td><?php
                                $price = $eoq->harga_barang($data['nama_barang']);
                                $jum = 2*$dem['demand']*$data['biaya_administrasi']/$price['harga_jual'];
                                $eoqq = sqrt($jum);
                                echo round($eoqq);
                                ?></td>
                                <td>
                                    <?php 
                                    // $ss = (90/100)*$dem['demand']*$data['lead_time'];
                                    $prt = $dem['demand']/4;
                                    $ss = ($dem['demand'] - $prt)*$data['lead_time'];
                                    echo round($ss);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $rop = $dem['demand']*$data['lead_time']+$ss;
                                    echo round($rop);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    // $max = $ss + $eoqq;
                                    $max = 2*($dem['demand']*$data['lead_time'])+$ss;
                                    echo round($max);
                                    ?>
                                </td>
                                <td>
                                    <a href="index.php?page=ubaheoq&id=<?php echo $data['kode_eoq']; ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit</a>
                                    <a href="index.php?page=eoq&hapus=<?php echo $data['kode_eoq']; ?>" class="btn btn-danger btn-xs" id="alertHapus"><i class="fa fa-trash"></i> Hapus</a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>   
            </div>
            <div class="panel-footer">
                <a href="index.php?page=tambaheoq" class="btn btn-info"><i class="fa fa-plus"></i> Tambah EOQ</a>
            </div>
        </div>
        <!--End Advanced Tables -->
    </div>
</div>