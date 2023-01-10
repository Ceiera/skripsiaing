<?= $this->extend('dashboard/statis/template');?>
<?= $this->section('content');?>
<div class="container-fluid">

<!-- Page Heading -->
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <?= form_open_multipart('dashboard/veriflanjut/kirim');?>
        <?= csrf_field(); ?>
        <div>
            <div class="card-body">
                <input type="text" class="form-control" id="namahewan" name="id_member" value="<?= session()->get('id_member')?>" hidden>
                <div class="form-group">
                    <label for="namalengkap">Nama Lengkap</label>
                    <input type="text" class="form-control" id="namalengkap" placeholder="Nama Lengkap" name="nama_lengkap">
                </div>
                <div class="form-group">
                    <label for="alamatktp">Alamat KTP</label>
                    <input type="text" class="form-control" id="alamatktp" placeholder="Alamat KTP" name="alamat_ktp">
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal_lahir">
                </div>
                <div class="form-group">
                    <label for="profesi">Profesi</label>
                    <input type="text" class="form-control" id="profesi" placeholder="profesi" name="profesi">
                </div>
                <div class="form-group">
                    <label for="jumlah penghuni">Jumlah Penghuni Rumah</label>
                    <input type="text" class="form-control" id="jumlah penghuni" placeholder="cth: 1" name="jumlah_penghuni">
                </div>
                <div class="form-group">
                  <label for="Bersedia Vaksinasi">Bersedia Vaksinasi</label>
                  <select class="custom-select form-control-border" id="Bersedia Vaksinasi" name="bersedia_vaksinasi">
                    <option >Ya</option>
                    <option >Tidak</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="Bersedia Sterilisasi">Bersedia Sterilisasi</label>
                  <select class="custom-select form-control-border" id="Bersedia Sterilisasi" name="bersedia_steril">
                    <option >Ya</option>
                    <option >Tidak</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="Status Tempat Tinggal">Status Tempat Tinggal</label>
                  <select class="custom-select form-control-border" id="Status Tempat Tinggal" name="status_tempat">
                    <option >Milik Sendiri</option>
                    <option >Bukan Milik Sendiri</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="Persetujuan Penghuni Rumah">Persetujuan Penghuni Rumah</label>
                  <select class="custom-select form-control-border" id="Persetujuan Penghuni Rumah" name="persetujuan_rumah">
                    <option >Disetujui</option>
                    <option >Belum Disetujui</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="Pernah Adopsi">Pernah Adopsi</label>
                  <select class="custom-select form-control-border" id="Pernah Adopsi" name="pernah_adopsi">
                    <option >Pernah</option>
                    <option >Belum Pernah</option>
                  </select>
                </div>
                <div class="form-group">
                    <label for="alasan adopsi">Alasan Adopsi</label>
                    <div class="input-group">
                    <textarea for= "alasan adopsi" name="alasan_adopsi" id="alasan adopsi" cols="100%" rows="10" placeholder="contoh: butuh teman"></textarea>
                    </div>
                   
                </div>
                <div class="input-group">
                    <div class="form-group">
                        <label for="fotorumah">Foto Rumah</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="fotorumah" class="custom-file-input" id="fotorumah" accept="image/png, image/jpg, image/jpeg">
                                <label class="custom-file-label" for="fotorumah">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">JPG/PNG</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="input-group">
                    <div class="form-group">
                        <label for="fotorumah2">Foto Rumah Sisi Lain</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="fotorumah2" class="custom-file-input" id="fotorumah2" onchange="readURL(this);" accept="image/png, image/jpg, image/jpeg">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">JPG/PNG</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="input-group">
                    <div class="form-group">
                        <label for="fotodiri">Foto Diri dan Rumah</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="fotodiri" class="custom-file-input" id="fotodiri" accept="image/png, image/jpg, image/jpeg">
                                <label class="custom-file-label" for="fotodiri">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">JPG/PNG</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="input-group">
                    <div class="form-group">
                        <label for="fotokandang">Foto Kandang/Tempat Hewan</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="fotokandang" class="custom-file-input" id="fotokandang"  accept="image/png, image/jpg, image/jpeg">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">JPG/PNG</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        <?= form_close()?>
    </div>
</div>
</div>
<?= $this->endSection();?>