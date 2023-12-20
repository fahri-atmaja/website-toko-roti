<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading">
                Data Barang Produksi
            </div>
            <div class="panel-body">
                <div class="table">
                    <table class="table table-striped table-bordered table-hover" id="tabelku">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Satuan</th>
                                <th>Modal</th>
                                <th>Item</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  
                                $pem = $pembelian->tampil_barang_pembelian();
                                foreach ($pem as $index => $data) {
                            ?>
                            <tr class="odd gradeX">
                                <td><?php echo $index + 1; ?></td>
                                <td><?php echo $data['nama_barang_beli']; ?></td>
                                <td><?php echo $data['satuan']; ?></td>
                                <td><?php echo rupiah($data['harga_beli']); ?></td>
                                <td><?php echo $data['item']; ?></td>
                                <td>
                                    <a href="index.php?page=simpanbaranggudang&kdbl=<?php echo $data['kd_barang_beli']; ?>&nmbrg=<?php echo $data['nama_barang_beli']; ?>" class="btn btn-success btn-xs"><i class="fa fa-download"></i> Masukan barang baru</button>
                                    <a href="index.php?page=stokbaranggudang&kdbl=<?php echo $data['kd_barang_beli']; ?>&nmbrg=<?php echo $data['nama_barang_beli']; ?>" class="btn btn-primary btn-xs"><i class="fa fa-download"></i> Masukan stok</button>
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