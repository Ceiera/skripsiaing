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
                    <button class="nav-link active" id="diProses-tab" data-bs-toggle="tab" data-bs-target="#diProses-tab-pane" type="button" role="tab" aria-controls="diProses-tab-pane" aria-selected="true">Diproses</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="final-tab" data-bs-toggle="tab" data-bs-target="#final-tab-pane" type="button" role="tab" aria-controls="final-tab-pane" aria-selected="false">Final</button>
                </li>
            </ul>   
        </div>
        <div class="tab-content" id="navTabelContent">
            <div class="tab-pane fade show active" id="diProses-tab-pane" role="tabpanel" aria-labelledby="diProses-tab" tabindex="0">
                <table class="table align-middle" id="dataTable" width="100%" cellspacing="0" role="tabpanel">
                    <thead style="text-align: center;">
                        <tr>
                            <th>Foto Hewan</th>
                            <th>Nama Hewan</th>
                            <th>Nama Calon Adopter</th>
                            <th>Status</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody style="text-align: center;">                            
                        <?php
                            foreach ($diproses as $key) { ?>
                            <tr>
                                <td style="text-align: center;">
                                    <img src="<?= base_url()?>/hewan/<?php echo ($key['foto'])?>" alt="" width="150px" height="150px">
                                </td>
                                <td name='id_member'><?php echo($key['nama_hewan']) ;?></td>
                                <td><?php echo($key['nama_lengkap']) ;?></td>
                                <td><?php echo($key['status_adopsi']) ;?></td>
                                <td style="text-align: center;">
                                    <a href="<?= base_url('dashboard/kelolaadopsi/pengajuan/').'/'.$key['id_adopsi'];?>"><button name="id_adopsi" type="submit" class="btn btn-warning " value="<?php echo($key['id_adopsi']) ;?>">Detail</button></a>
                                </td>
                            </tr>
                        <?php } ;?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="final-tab-pane" role="tabpanel" aria-labelledby="final-tab" tabindex="0">
                <table class="table align-middle" id="dataTable" width="100%" cellspacing="0" role="tabpanel">
                    <thead style="text-align: center;">
                        <tr>
                            <th>Foto Hewan</th>
                            <th>Nama Hewan</th>
                            <th>Nama Calon Adopter</th>
                            <th>Status</th>
                            <th>Dibatalkan Oleh</th>
                        </tr>
                    </thead>
                    <tbody style="text-align: center;">                            
                        <?php
                            foreach ($final as $key) { ?>
                            <tr>
                                <td style="text-align: center;">
                                    <img src="<?= base_url()?>/hewan/<?php echo ($key['foto'])?>" alt="" width="150px" height="150px">
                                </td>
                                <td name='id_member'><?php echo($key['nama_hewan']) ;?></td>
                                <td><?php echo($key['nama_lengkap']) ;?></td>
                                <td>
                                    <?php if ($key['status_adopsi']=='Berhasil') {
                                       echo '<span class="badge badge-success">Berhasil</span>';
                                    }else {
                                        echo '<span class="badge badge-danger">Gagal</span>';
                                    } ;?>
                                </td>
                                <td><?php if ($key['dibatalkan_oleh']== session()->get('id_member')) {
                                    echo '<span class="badge badge-success">Saya</span>';
                                }elseif ($key['dibatalkan_oleh']==$key['id_member_calon']) {
                                    echo '<span class="badge badge-danger">Calon Adopter</span>';
                                }else{
                                    echo '-';
                                } ?></td>
                            </tr>
                        <?php } ;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<!-- End of Main Content -->
<?= $this->endSection();?>