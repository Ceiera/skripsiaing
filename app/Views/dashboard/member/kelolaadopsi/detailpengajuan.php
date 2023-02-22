<?= $this->extend('dashboard/statis/template');?>
<?= $this->section('content');?>
<section class="section about-section gray-bg" id="about">
        <div class="container">
            <div class="counter" style="padding: 22px 20px; background: #ffffff; border-radius: 10px; box-shadow: 0 0 30px rgba(31, 45, 61, 0.125);">
                <div class="row align-items-center flex-row">
                    <div class="col-8">
                        <div class="about-text go-to">
                            <h3 class="dark-color">Pemilik: <?= $data['nama_lengkap']?></h3>
                            <h6 class="theme-color lead">Profesi: <?= $data['profesi']?></h6>
                            <p><?= $data['alamat_ktp']?></p>
                            <p>Alasan Adopsi: <?= $data['alasan_adopsi_lagi']?></p>
                            
                        </div>
                    </div>
                    <div class="col">
                        <div class="position-relative">
                            <div class="" style="text-align: center;">
                                <img class="rounded-circle" src="<?= base_url('/verifikasi').'/'.$data['foto_dirirumah']?>" title="" alt="" width="300px" height="300px">
                            </div>
                        </div>
                        <br>
                        <div class="row align-items-center"  style="text-align: center;">
                            <div class="col">
                                <button class="btn btn-success btn-user btn-block" data-toggle="modal" data-target="#terima"><?php 
                                    if ($data['status_adopsi']=='Menunggu Diterima') {
                                        echo 'Notify';
                                    }else {
                                        echo 'Lanjut Proses Pembayaran';
                                    }
                                ?></button>
                            </div>
                            <div class="col">
                                <button class="btn btn-danger btn-user btn-block"  data-toggle="modal" data-target="#tolak">Tolak</button>
                            </div>                          
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div  style="padding: 22px 20px; background: #ffffff; border-radius: 10px; box-shadow: 0 0 30px rgba(31, 45, 61, 0.125);">
                <ul class="nav nav-tabs" id="tabelAbout" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="datadiri-tab" data-bs-toggle="tab" data-bs-target="#datadiri-tab-pane" type="button" role="tab" aria-controls="datadiri-tab-pane" aria-selected="true">Data Diri</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="foto-tab" data-bs-toggle="tab" data-bs-target="#foto-tab-pane" type="button" role="tab" aria-controls="foto-tab-pane" aria-selected="false">Foto Rumah Calon Pengadopsi</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="hewan-tab" data-bs-toggle="tab" data-bs-target="#hewan-tab-pane" type="button" role="tab" aria-controls="hewan-tab-pane" aria-selected="false">Hewan yang ingin Diadopsi</button>
                    </li>
                </ul>
                <div class="tab-content" id="tabelAboutContent">
                    <div class="tab-pane fade show active" id="datadiri-tab-pane" role="tabpanel" aria-labelledby="datadiri-tab" tabindex="0">
                        <div class="grid gap-0 row-gap-3">
                            <div class="p-2 row justify">
                                <div class="col-2">No. HP</div>
                                <div class="col-auto">:</div>
                                <div class="col-auto">
                                    <?= $data['no_hp']?><a href="http://wa.me/<?= $data['no_hp']?>" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-whatsapp" style="color: green;"></i></a>
                                </div>
                            </div>
                            <div class="p-2 row justify">
                                <div class="col-2">Email</div>
                                <div class="col-auto">:</div>
                                <div class="col-auto"><?= $data['email']?></div>
                            </div>
                            <div class="p-2 row justify">
                                <div class="col-2">Umur</div>
                                <div class="col-auto">:</div>
                                <div class="col-auto">
                                    <?php $tz  = new DateTimeZone('Asia/Jakarta');
                                    $age = DateTime::createFromFormat('Y-m-d', $data['tanggal_lahir'], $tz)->diff(new DateTime('now', $tz))->y;
                                    echo $age;?>
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <div class="tab-pane fade" id="hewan-tab-pane" role="tabpanel" aria-labelledby="hewan-tab" tabindex="0">
                        <div class="grid gap-0 row-gap-3">
                            <div class="p-2 row justify">
                                <div class="col-2">Nama Hewan</div>
                                <div class="col-auto">:</div>
                                <div class="col-auto">
                                    <?= $data['nama_hewan']?>
                                </div>
                            </div>
                            <div class="p-2 row justify">
                                <div class="col-2">Jenis Hewan</div>
                                <div class="col-auto">:</div>
                                <div class="col-auto">
                                    <?= $data['jenis_hewan']?>
                                </div>
                            </div>
                            <div class="p-2 row justify">
                                <div class="col-2">Tanggal Lahir</div>
                                <div class="col-auto">:</div>
                                <div class="col-auto">
                                    <?= $data['tanggal_lahir']?>
                                </div>
                            </div>
                            <div class="p-2 row justify">
                                <div class="col-2">Berat</div>
                                <div class="col-auto">:</div>
                                <div class="col-auto">
                                    <?= $data['berat']?>
                                </div>
                            </div>
                            <div class="p-2 row justify">
                                <div class="col-2">Jenis Kelamin</div>
                                <div class="col-auto">:</div>
                                <div class="col-auto">
                                    <?= $data['jenis_kelaminh']?>
                                </div>
                            </div>
                            <div class="p-2 row justify">
                                <div class="col-2">Vaksinasi</div>
                                <div class="col-auto">:</div>
                                <div class="col-auto">
                                  <?php if ($data['vaksinasi']=='0') {
                                    echo '<span class="badge badge-danger">Belum</span>';
                                  }else {
                                    echo '<span class="badge badge-succes">Sudah</span>';
                                  }?>
                                </div>
                            </div>
                            <div class="p-2 row justify">
                                <div class="col-2">Steril</div>
                                <div class="col-auto">:</div>
                                <div class="col-auto">
                                  <?php if ($data['steril']=='0') {
                                    echo '<span class="badge badge-danger">Belum</span>';
                                  }else {
                                    echo '<span class="badge badge-succes">Sudah</span>';
                                  }?>
                                </div>
                            </div>
                            <div class="p-2 row justify">
                                <div class="col-2">kemampuan_khusus</div>
                                <div class="col-auto">:</div>
                                <div class="col-auto">
                                    <?= $data['kemampuan_khusus']?>
                                </div>
                            </div>
                            <div class="p-2 row justify">
                                <div class="col-2">Biaya Ganti</div>
                                <div class="col-auto">:</div>
                                <div class="col-auto">
                                    Rp. <?= $data['biaya_ganti']?>
                                </div>
                            </div>
                            <div class="p-2 row justify" style="text-align: center;">
                              <div>
                                <img class="flex rounded-circle" src="<?= base_url('/hewan').'/'.$data['foto']?>" title="" alt="" style="width: 50%;">
                              </div>
                            </div>
                        </div>
                    </div>
                </div>          
            </div>
            <div class="modal fade" tabindex="-1" role="dialog" id="terima">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Lanjut Langkahmu?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <?php 
                            if ($data['status_adopsi']=='Menunggu Diterima') {
                                echo "<p>Nama Calon Pengadopsi: ".$data['nama_lengkap']."dengan Nama Hewan yang ingin diadopsi:". $data['nama_hewan']."akan diingatkan kembali?</p>";
                            }else {
                                echo "<p>Nama Calon Pengadopsi: ".$data['nama_lengkap']."dengan Nama Hewan yang ingin diadopsi:". $data['nama_hewan']."akan dilanjutkan ke proses pembayaran (jika ada)?</p>";
                            }
                            ?>
                        </div>
                        <div class="modal-footer" >
                            <div class="col">
                            <button type="button" class="btn btn-secondary btn-user btn-block" data-dismiss="modal">
                                <span aria-hidden="true">Batal</span>
                            </button>
                            </div>
                            <div class="col">
                                <?= form_open('/dashboard/kelolaadopsi/pengajuan/terima')?>
                                    <button class="btn btn-success btn-user btn-block" name="id_adopsi" value="<?= $data['id_adopsi']?>">Simpan</button>
                                    <input type="text" hidden name="id_member_pemilik" value="<?= $data['id_member_pemilik']?>">
                                    <input type="text" hidden name="id_hewan" value="<?= $data['id_hewan']?>">
                                <?= form_close()?>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" tabindex="-1" role="dialog" id="tolak">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Batalkan?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Nama Calon Pengadopsi: <?= $data['nama_lengkap']?> dengan Nama Hewan yang ingin diadopsi: <?=  $data['nama_hewan']?> akan dibatalkan?</p>
                        </div>
                        <div class="modal-footer" >
                            <div class="col">
                            <button type="button" class="btn btn-secondary btn-user btn-block" data-dismiss="modal" >
                                <span aria-hidden="true">Batal</span>
                            </button>
                            </div>
                            <div class="col">
                                <?= form_open('/dashboard/kelolaadopsi/pengajuan/tolak')?>
                                <?= csrf_field();?>
                                    <div class="form-group">
                                        <input type="text" hidden name="id_member_pemilik" value="<?= $data['id_member_pemilik']?>">
                                        <input type="text" hidden name="id_hewan" value="<?= $data['id_hewan']?>">
                                        <button class="btn btn-success btn-user btn-block" type="submit" name="id_adopsi" value="<?= $data['id_adopsi']?>">Simpan</button>
                                    </div>
                                <?= form_close()?>
                            </div>
                            
                        </div>
                    </div>
                </div>
        
            </div>
        </div>
  </section>
<?= $this->endSection();?>