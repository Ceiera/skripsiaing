<?= $this->extend('dashboard/statis_admin/template');?>
<?= $this->section('content');?>
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Verifikasi</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered align-middle" id="dataTable" width="100%" cellspacing="0">
                <thead align="center">
                    <tr>
                        <th>Foto Diri & Rumah</th>
                        <th>Id_verifikasi</th>
                        <th>Nama User</th>
                        <th>Nama KTP</th>
                        <th>No HP</th>
                        <th>Umur</th>
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
                                    <img src="<?= base_url()?>/verifikasi/<?php echo ($key['foto_dirirumah'])?>" alt="" width="150px" height="150px">
                                </td>
                                <td name='id_verifikasi'><?php echo($key['id_verifikasi']) ;?></td>
                                <td><?php echo($key['username']) ;?></td>
                                <td><?php echo($key['nama_lengkap']) ;?></td>
                                <td><?php echo($key['no_hp']) ;?></td>
                                <td><?php 
                                        $tz  = new DateTimeZone('Asia/Jakarta');
                                        $age = DateTime::createFromFormat('Y-m-d', $key['tanggal_lahir'], $tz)->diff(new DateTime('now', $tz))->y;
                                        echo $age;
                                    ?>
                                </td>  
                                <td align="center">
                                    <a href="<?= base_url('admin/veriflanjut').'/'.$key['id_verifikasi'];?>" class="btn btn-warning ">Detail</a>
                                </td>
                                <td align="center">
                                     <?= form_open('admin/veriflanjut/hapus');?>
                                        <button name="id_verifikasi" type="submit" class="btn btn-danger" value="<?php echo($key['id_verifikasi']) ;?>">Tolak</button>
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
<?= $this->endSection();?>