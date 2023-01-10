<?= $this->extend('dashboard/statis_admin/template');?>
<?= $this->section('content');?>
<?php foreach ($data as $key) {?>
    <section class="section about-section gray-bg" id="about">
            <div class="container">
                <div class="row align-items-center flex-row-reverse">
                    <div class="col-8">
                        <div class="about-text go-to">
                            <h3 class="dark-color"><?= $key['nama_lengkap']?></h3>
                            <h6 class="theme-color lead">Profesi: <?= $key['profesi']?></h6>
                            <p><?= $key['alamat_ktp']?></p>
                            <p>Alasan Adopsi: <?= $key['alasan_adopsi_lagi']?></p>
                            <div class="row about-list">
                                <div class="col-md-6">
                                    <div class="media">
                                        <label>No HP:</label>
                                        <p><?= $key['no_hp']?></p>
                                    </div>
                                    <div class="media">
                                        <label>Nomer Bank</label>
                                        <p><?= $key['bank_code']?></p>
                                    </div>
                                    <div class="media">
                                        <label>Umur: </label>
                                        <p><?php $tz  = new DateTimeZone('Asia/Jakarta');
                                        $age = DateTime::createFromFormat('Y-m-d', $key['tanggal_lahir'], $tz)->diff(new DateTime('now', $tz))->y;
                                        echo $age;?></p>
                                    </div>
                                    <div class="media">
                                        <label>Jumlah Penghuni Rumah</label>
                                        <p><?=$key['jum_penghuni_rumah']?></p>
                                    </div>
                                    <div class="media">
                                        <label>Persetujuan Penghuni Rumah</label>
                                        <p><?=$key['persetujuan_penghuni_rumah']?></p>
                                    </div>
                                    <div class="media">
                                        <label>Pernah Adopsi</label>
                                        <p><?=$key['pernah_adopsi']?></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="media">
                                        <label>Nama Akun Bank: </label>
                                        <p><?= $key['nama_akunbank']?></p>
                                    </div>
                                    <div class="media">
                                        <label>E-mail</label>
                                        <p><?= $key['email']?></p>
                                    </div>
                                    <div class="media">
                                        <label>Bersedia Vaksinasi Rutin</label>
                                        <p><?= $key['bersedia_vaksinasi_rutin']?></p>
                                    </div>
                                    <div class="media">
                                        <label>Bersedia Steril</label>
                                        <p><?= $key['bersedia_steril']?></p>
                                    </div>
                                    <div class="media">
                                        <label>Status Tempat Tinggal</label>
                                        <p><?= $key['status_tempat_tinggal']?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="about-avatar">
                            <img src="<?= base_url('/verifikasi').'/'.$key['foto_dirirumah']?>" title="" alt="" width="300px" height="300px" >
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-6">
                                <button class="btn btn-success btn-user btn-block" data-toggle="modal" data-target="#terima">Terima</button>
                            </div>
                            <div class="col-lg-4">
                                <button class="btn btn-danger btn-user btn-block"  data-toggle="modal" data-target="#tolak">Tolak</button>
                            </div>                          
                        </div>
                    </div>
                </div>
                <div class="counter" style="padding: 22px 20px; background: #ffffff; border-radius: 10px; box-shadow: 0 0 30px rgba(31, 45, 61, 0.125);">
                    <div class="row" data-toggle="modal" data-target="#exampleModal">
                        <div class="col-6 col-lg-3">
                            <div class="count-data text-center">
                            <img src="<?= base_url('/verifikasi').'/'.$key['foto_dirirumah']?>" title="" alt="" width="200px" height="200px" data-target="#carouselExample" data-slide-to="0">
                            </div>
                        </div>
                        <div class="col-6 col-lg-3">
                            <div class="count-data text-center">
                            <img src="<?= base_url('/verifikasi').'/'.$key['foto_rumah']?>" title="" alt="" width="200px" height="200px" data-target="#carouselExample" data-slide-to="1">
                            </div>
                        </div>
                        <div class="col-6 col-lg-3">
                            <div class="count-data text-center">
                            <img src="<?= base_url('/verifikasi').'/'.$key['foto_rumah2']?>" title="" alt="" width="200px" height="200px" data-target="#carouselExample" data-slide-to="2">
                            </div>
                        </div>
                        <div class="col-6 col-lg-3">
                            <div class="count-data text-center">
                            <img src="<?= base_url('/verifikasi').'/'.$key['foto_kandang']?>" title="" alt="" width="200px" height="200px" data-target="#carouselExample" data-slide-to="3">
                            </div>
                        </div>
                    </div>
                <!-- Modal IMG-->
                <!-- 
                This part is straight out of Bootstrap docs. Just a carousel inside a modal.
                -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div id="carouselExample" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#carouselExample" data-slide-to="0" class="active"></li>
                                    <li data-target="#carouselExample" data-slide-to="1"></li>
                                    <li data-target="#carouselExample" data-slide-to="2"></li>
                                    <li data-target="#carouselExample" data-slide-to="3"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                    <img class="d-block w-100" src="<?= base_url('/verifikasi').'/'.$key['foto_dirirumah']?>" alt="foto diri">
                                    </div>
                                    <div class="carousel-item">
                                    <img class="d-block w-100" src="<?= base_url('/verifikasi').'/'.$key['foto_rumah']?>" alt="foto rumah">
                                    </div>
                                    <div class="carousel-item">
                                    <img class="d-block w-100" src="<?= base_url('/verifikasi').'/'.$key['foto_rumah2']?>" alt="foto rumah">
                                    </div>
                                    <div class="carousel-item">
                                    <img class="d-block w-100" src="<?= base_url('/verifikasi').'/'.$key['foto_kandang']?>" alt="foto kandang">
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal" tabindex="-1" role="dialog" id="terima">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Terima Submit Verifikasi?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>No ID Verifikasi: <?= $key['id_verifikasi']?> dengan nama lengkap <?=  $key['nama_lengkap']?> akan diterima dan menjadi akun terverifikasi?</p>
                        </div>
                        <div class="modal-footer" >
                            <div class="col">
                            <button type="button" class="btn btn-secondary btn-user btn-block" data-dismiss="modal" >
                                <span aria-hidden="true">Batal</span>
                            </button>
                            </div>
                            <div class="col">
                                <?= form_open('/admin/veriflanjut/terima')?>
                                    <button class="btn btn-success btn-user btn-block" name="id_verifikasi" value="<?= $key['id_verifikasi']?>">Simpan</button>
                                    <input type="text" disabled hidden name="id_member" value="<?= $key['id_member']?>">
                                <?= form_close()?>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal" tabindex="-1" role="dialog" id="tolak">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tolak Submit Verifikasi?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>No ID Verifikasi: <?= $key['id_verifikasi']?> dengan nama lengkap <?=  $key['nama_lengkap']?> akan ditolak?</p>
                        </div>
                        <div class="modal-footer" >
                            <div class="col">
                            <button type="button" class="btn btn-secondary btn-user btn-block" data-dismiss="modal" >
                                <span aria-hidden="true">Batal</span>
                            </button>
                            </div>
                            <div class="col">
                                <?= form_open('/admin/veriflanjut/tolak')?>
                                    <button class="btn btn-success btn-user btn-block" name="id_verifikasi" value="<?= $key['id_verifikasi']?>">Simpan</button>
                                    <input type="text" disabled hidden name="id_member" value="<?= $key['id_member']?>">
                                <?= form_close()?>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
    </section>
<?php }?>
<?= $this->endSection();?>