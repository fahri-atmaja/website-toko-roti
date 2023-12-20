<?php  
    // if (isset($_GET['hapus'])) {
    //     $barang->hapus_barang($_GET['hapus']);
    //     echo "<script>location='index.php?page=barang';</script>";
    // }
?>
<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading">
               Activity Log 
            </div>
            <div class="panel-body">
                <div class="table">
                    <table class="table table-striped table-bordered table-hover" id="tabelku">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>User</th>
                                <th>Deskripsi</th>
                                <th>Waktu</th>
                                <!--<th>Aksi</th>-->
                            </tr>
                        </thead>
                        <tbody>
                            <?php  
                                $no = 1;
                                $logg = $log->tampil_log();
                                foreach ($logg as $index => $data) {
                            ?>
                            <tr class="odd gradeX">
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $data['nama']; ?></td>
                                <td><?php echo $data['deskripsi']; ?></td>
                                <td><?php echo $data['waktu']; ?></td>
                                <?php if($_SESSION['login_admin']['status']==1){ ?>
                                <!--<td>-->
                                    <!--<a href="index.php?page=ubahbarang&id=<?php echo $data['kd_barang']; ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit</a>-->
                                    <!--<a href="index.php?page=barang&hapus=<?php echo $data['kd_barang']; ?>" class="btn btn-danger btn-xs" id="alertHapus"><i class="fa fa-trash"></i> Hapus</a>-->
                                <!--</td>-->
                                <?php } else { ?>
                                <!--<td>Tidak ad aksi</td>-->
                                <?php } ?>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>   
            </div>
            <!--<div class="panel-footer">-->
            <!--    <a href="index.php?page=tambahbarang" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Barang</a>-->
            <!--</div>-->
        </div>
        <!--End Advanced Tables -->
    </div>
</div>