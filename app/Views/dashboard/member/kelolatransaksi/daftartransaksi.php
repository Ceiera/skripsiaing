<?= $this->extend('dashboard/statis/template');?>
<?= $this->section('content');?>
<!-- Begin Page Content -->
<div class="container">
    <div class="card shadow mb-4">
        
            <?php 
                if (session()->getFlashdata('alert')) {
                    echo '<div class="row px-2"><p class="alert alert-danger">'.session()->getFlashdata('alert').'</p></div>';
                }
            ?>
        <div class="card-header py-3">
            <ul class="nav nav-tabs" id="tabelAbout" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="menunggu-tab" data-bs-toggle="tab" data-bs-target="#menunggu-tab-pane" type="button" role="tab" aria-controls="menunggu-tab-pane" aria-selected="false">Menunggu Dibayar</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="sedangBerjalan-tab" data-bs-toggle="tab" data-bs-target="#sedangBerjalan-tab-pane" type="button" role="tab" aria-controls="sedangBerjalan-tab-pane" aria-selected="true">Sedang Berjalan</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="selesai-tab" data-bs-toggle="tab" data-bs-target="#selesai-tab-pane" type="button" role="tab" aria-controls="selesai-tab-pane" aria-selected="false">Selesai</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="gagal-tab" data-bs-toggle="tab" data-bs-target="#gagal-tab-pane" type="button" role="tab" aria-controls="gagal-tab-pane" aria-selected="false">Gagal</button>
                </li>
            </ul>   
        </div>
        <div class="tab-content" id="navTabelContent">
            <div class="tab-pane fade" id="menunggu-tab-pane" role="tabpanel" aria-labelledby="menunggu-tab" tabindex="0">
                <table class="table align-middle" id="dataTable" width="100%" cellspacing="0" role="tabpanel">
                    <thead style="text-align: center;">
                        <tr>
                            <th>Foto Hewan</th>
                            <th>Nama Hewan</th>
                            <th>Dibuat Tanggal</th>
                            <th>Nominal</th>
                            <th>Status Transaksi</th>
                            <th colspan="2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody style="text-align: center;">
                    <?php
                        foreach ($menungguDibayar as $menunggu) {?>
                            <td align="center">
                                <img src="<?= base_url()?>/hewan/<?php echo ($menunggu['foto'])?>" alt="" width="150px" height="150px">
                            </td>
                            <td><?= $menunggu['nama_hewan']?></td>
                            <td><?= $menunggu['created_at']?></td>
                            <td><?= $menunggu['harga_diterima']?></td>
                            <td><?= $menunggu['status_transaksi']?></td>
                            <td><button class="btn btn-danger">Batal</button></td>
                            <td><button class="btn btn-info">Lanjutkan</button></td>
                        <?php }
                    ?>
                    </tbody> 
                </table>
            </div>
            <div class="tab-pane fade show active" id="sedangBerjalan-tab-pane" role="tabpanel" aria-labelledby="sedangBerjalan-tab" tabindex="0">
                <table class="table align-middle" id="dataTable" width="100%" cellspacing="0" role="tabpanel">
                    <thead style="text-align: center;">
                        <tr>
                            <th>Foto Hewan</th>
                            <th>Nama Hewan</th>
                            <th>Dibuat Tanggal</th>
                            <th>Nominal</th>
                            <th>Status Transaksi</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody style="text-align: center;">                            
                    <?php
                        foreach ($sedangBerjalan as $proses) {?>
                            <td align="center">
                                <img src="<?= base_url()?>/hewan/<?php echo ($proses['foto'])?>" alt="" width="150px" height="150px">
                            </td>
                            <td><?= $proses['nama_hewan']?></td>
                            <td><?= $proses['created_at']?></td>
                            <td><?= $proses['harga_diterima']?></td>
                            <td><?= $proses['status_transaksi']?></td>
                            <td><button class="btn btn-warning">Detail</button></td>
                        <?php }
                    ?>   
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="selesai-tab-pane" role="tabpanel" aria-labelledby="selesai-tab" tabindex="0">
                <table class="table align-middle" id="dataTable" width="100%" cellspacing="0" role="tabpanel">
                    <thead style="text-align: center;">
                        <tr>
                            <th>Foto Hewan</th>
                            <th>Nama Hewan</th>
                            <th>Dibuat Tanggal</th>
                            <th>Nominal</th>
                            <th>Status Transaksi</th>
                            <th>Dibatalkan Oleh</th>
                        </tr>
                    </thead>
                    <tbody style="text-align: center;">
                    <?php
                        foreach ($berhasil as $proses) {?>
                            <td align="center">
                                <img src="<?= base_url()?>/hewan/<?php echo ($proses['foto'])?>" alt="" width="150px" height="150px">
                            </td>
                            <td><?= $proses['nama_hewan']?></td>
                            <td><?= $proses['created_at']?></td>
                            <td><?= $proses['harga_diterima']?></td>
                            <td><?= $proses['status_transaksi']?></td>
                            <td><button class="btn btn-info">Detail</button></td>
                        <?php }
                    ?>                  
                    </tbody> 
                </table>
            </div>
            <div class="tab-pane fade" id="gagal-tab-pane" role="tabpanel" aria-labelledby="gagal-tab" tabindex="0">
                <table class="table align-middle" id="dataTable" width="100%" cellspacing="0" role="tabpanel">
                    <thead style="text-align: center;">
                        <tr>
                            <th>Foto Hewan</th>
                            <th>Nama Hewan</th>
                            <th>Dibuat Tanggal</th>
                            <th>Nominal</th>
                            <th>Status Transaksi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody style="text-align: center;"> 
                    <?php
                        foreach ($gagal as $proses) {?>
                            <td align="center">
                                <img src="<?= base_url()?>/hewan/<?php echo ($proses['foto'])?>" alt="" width="150px" height="150px">
                            </td>
                            <td><?= $proses['nama_hewan']?></td>
                            <td><?= $proses['created_at']?></td>
                            <td><?= $proses['harga_diterima']?></td>
                            <td><?= $proses['status_transaksi']?></td>
                            <td><button class="btn btn-info">Detail</button></td>
                        <?php }
                    ?>                              
                    </tbody> 
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<!-- End of Main Content -->
<?= $this->endSection();?>