<?= $this->extend('dashboard/statis_admin/template');?>
<?= $this->section('content');?>
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Tables</h1>
<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
    For more information about DataTables, please visit the <a target="_blank"
        href="https://datatables.net">official DataTables documentation</a>.</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>id_member</th>
                        <th>username</th>
                        <th>email</th>
                        <th>no_hp</th>
                        <th>created_at</th>
                        <th>updated_at</th>
                        <th>BAN</th>
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
                        <?php foreach ($data as $key) { ?>
                            <tr>
                            <td name='id_member'><?php echo($key['id_member']) ;?></td>
                            <td><?php echo($key['username']) ;?></td>
                            <td><?php echo($key['email']) ;?></td>
                            <td><?php echo($key['no_hp']) ;?></td>
                            <td><?php echo($key['created_at']) ;?></td>
                            <td><?php echo($key['updated_at']) ;?></td>
                            <?= form_open('dashboard/kelolamember/hapus');?>
                            <td>
                                <button name="id_hapus" type="submit" class="btn btn-primary btn-user btn-block" value="<?php echo($key['id_member']) ;?>">HAPUS</button>
                            </td>
                            <?= form_close();?>
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