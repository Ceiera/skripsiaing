<?= $this->extend('dashboard/statis/template');?>
<?= $this->section('content');?>
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <?= form_open_multipart('dashboard/kelolahewan/upload');?>
        <?= csrf_field(); ?>
        <div>
            <div class="card-body">
                <input type="text" class="form-control" id="namahewan" name="id_hewan" hidden value="<?= session()->getFlashdata('id_hewan')?>">
                <input type="text" class="form-control" id="namahewan" name="id_member" value="<?= session()->get('id_member')?>" hidden>
                <div class="form-group">
                    <label for="namahewan">Nama Hewan</label>
                    <input type="text" class="form-control" id="namahewan" placeholder="Nama Hewan" name="nama_hewan" required value="<?= session()->getFlashdata('nama_hewan')?>">
                </div>
                <div class="form-group">
                  <label for="Jenis Kelamin">Jenis Kelamin</label>
                  <select class="custom-select form-control-border" id="Jenis Kelamin" name="jenis_kelamin">
                    <option <?php if (session()->getFlashdata('jenis_kelaminh')=='Jantan') {
                       echo 'selected';
                    }?>>Jantan</option>
                    <option <?php if (session()->getFlashdata('jenis_kelaminh')=='Betina') {
                       echo 'selected';
                    }?>>Betina</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="Jenis Hewan">Jenis Hewan</label>
                  <select class="custom-select form-control-border" id="Jenis Hewan" name="jenis_hewan">
                    <option <?php if (session()->getFlashdata('jenis_hewan')=='Kucing') {
                       echo 'selected';
                    }?>>Kucing</option>
                    <option <?php if (session()->getFlashdata('jenis_hewan')=='Anjing') {
                       echo 'selected';
                    }?>>Anjing</option>
                  </select>
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal Lahir Hewan</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal_lahir" required value="<?php echo session()->getFlashdata('tanggal')?>">
                </div>
                <div class="form-group">
                    <label for="berat">Berat Hewan</label>
                    <div class="input-group">
                        <input type="number" min="0" class="form-control" id="berat" placeholder="Berat Hewan" name="berat" required pattern="[0-9]" value="<?php echo session()->getFlashdata('berat')?>">
                        <div class="input-group-append">
                            <span class="input-group-text">KG</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                  <label for="vaksinasi">Sudah Vaksinasi?</label>
                  <select class="custom-select form-control-border" id="vaksinasi" name="vaksinasi">
                    <option value="0">Belum</option>
                    <option value="1">Sudah</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="steril">Sudah Steril?</label>
                  <select class="custom-select form-control-border" id="steril" name="steril">
                    <option <?php if (session()->getFlashdata('steril')=='0') {
                       echo 'selected';
                    }?> value="0">Belum</option>
                    <option <?php if (session()->getFlashdata('steril')=='1') {
                       echo 'selected';
                    }?> value="1">Sudah</option>
                  </select>
                </div>
                <div class="form-group">
                    <label for="biaya">Biaya Ganti Hewan</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <span class="input-group-text">Rp</span>
                        </div>
                        <input type="number" min="0" class="form-control" id="biaya" placeholder="1000000" name="biaya" required pattern="[0-9]" value="<?php echo session()->getFlashdata('biaya_ganti')?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="kemampuan khusus">Kemampuan Khusus Hewan</label>
                    <textarea name="kemampuan_khusus" id="kemampuan khusus" cols="113%" rows="10" placeholder="Sangat penurut, terlatih"><?php echo session()->getFlashdata('kemampuan_khusus')?></textarea>
                </div>
                <div class="input-group">
                    <div class="form-group">
                        <label for="exampleInputFile">File input</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="fotohewan" class="custom-file-input" id="exampleInputFile" onchange="readURL(this);" accept="image/png, image/jpg, image/jpeg">
                                <input type="text" hidden name="namafotolama" value="<?php echo (session()->getFlashdata('foto'))?>">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">JPG/PNG</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div >
                    <img id="fotohewan" src="<?= base_url()?>/hewan/<?php echo (session()->getFlashdata('foto'))?>" alt="your image" style="width: 600px;" />
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        <?= form_close()?>
    </div>
</div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#fotohewan').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<?= $this->endSection();?>