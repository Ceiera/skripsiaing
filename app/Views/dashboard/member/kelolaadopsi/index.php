<?= $this->extend('dashboard/statis/template');?>
<?= $this->section('content');?>
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <table>
            <tr>
                <td><a href="<?= base_url('/pasar')?>" class="btn btn-primary btn-user btn-block">Tambah</a></td>
            </tr>
        </table>
    </div>
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Hewan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered align-middle" id="dataTable" width="100%" cellspacing="0">
                <thead align="center">
                    <tr>
                        <th>Foto</th>
                        <th>Nama Hewan</th>
                        <th>Jenis Hewan</th>
                        <th>Tanggal Lahir</th>
                        <th colspan="2">AKSI</th>
                    </tr>
                </thead>
                <!-- <tfoot>
                    <tr>
                        <th>id_member</th>
                        <th>username</th>
                        <th>email</th>
                        <th>no_hp</th>
                        <th>created_at</th>
                        <th>updated_at</th>
                    </tr>
                </tfoot> -->
                <tbody>
                    <div>
                        <?php

use PhpParser\Node\Stmt\Echo_;

 foreach ($data as $key) { ?>
                            <tr>
                                <td align="center">
                                    <img src="<?= base_url()?>/hewan/<?php echo ($key['foto'])?>" alt="" width="150px" height="150px">
                                </td>
                                <td name='id_member'><?php echo($key['nama_hewan']) ;?></td>
                                <td><?php echo($key['jenis_hewan']) ;?></td>
                                <td><?php echo($key['tanggal_lahir']) ;?></td>
                                <td align="center">
                                    <?= form_open('dashboard/kelolaadopsi/detail');?>
                                        <button name="id_hewan" type="submit" class="btn btn-warning " value="<?php echo($key['id_hewan']) ;?>">Detail</button>
                                    <?= form_close()?>
                                   
                                </td>
                                <td align="center">
                                     <?= form_open('dashboard/kelolaadopsi/hapus');?>
                                        <button name="id_hewan" type="submit" class="btn btn-danger" value="<?php echo($key['id_hewan']) ;?>">HAPUS</button>
                                    <?= form_close();?>
                                </td>
                           </tr>
                        <?php } ;?>
                    </div>
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?= $this->endSection();?>