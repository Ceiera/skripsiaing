<?= $this->extend('dashboard/statis_admin/template');?>
<?= $this->section('content');?>
    <section class="section about-section gray-bg" id="about">
        <div class="container">
            <div class="counter" style="padding: 22px 20px; background: #ffffff; border-radius: 10px; box-shadow: 0 0 30px rgba(31, 45, 61, 0.125);">
                <div class="row align-items-center flex-row">
                    <div class="col-8">
                        <div class="about-text go-to">
                            <h3 class="dark-color"><?= $data['nama_lengkap']?></h3>
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
                                <button class="btn btn-success btn-user btn-block" data-toggle="modal" data-target="#terima">Terima</button>
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
                        <button class="nav-link" id="foto-tab" data-bs-toggle="tab" data-bs-target="#foto-tab-pane" type="button" role="tab" aria-controls="foto-tab-pane" aria-selected="false">Foto</button>
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
                                <div class="col-2">Kode Bank</div>
                                <div class="col-auto">:</div>
                                <div class="col-auto"><?= $data['bank_code']?></div>
                            </div>
                            <div class="p-2 row justify">
                                <div class="col-2">Nomer Bank</div>
                                <div class="col-auto">:</div>
                                <div class="col-auto"><?= $data['nomer_rekening']?></div>
                            </div>
                            <div class="p-2 row justify">
                                <div class="col-2">Nama Akun Bank</div>
                                <div class="col-auto">:</div>
                                <div class="col-auto"><?= $data['nama_akunbank']?></div>
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
                            <div class="p-2 row justify">
                                <div class="col-2">Status Tempat Tinggal</div>
                                <div class="col-auto">:</div>
                                <div class="col-auto"><?= $data['status_tempat_tinggal']?></div>
                            </div>
                            <div class="p-2 row justify">
                                <div class="col-2">Jumlah Penghuni Rumah</div>
                                <div class="col-auto">:</div>
                                <div class="col-auto"><?= $data['jum_penghuni_rumah']?></div>
                            </div>
                            <div class="p-2 row justify">
                                <div class="col-2">Persetujuan Penghuni Rumah</div>
                                <div class="col-auto">:</div>
                                <div class="col-auto"><?= $data['persetujuan_penghuni_rumah']?></div>
                            </div>
                            <div class="p-2 row justify">
                                <div class="col-2">Bersedia Vaksinasi</div>
                                <div class="col-auto">:</div>
                                <div class="col-auto"><?= $data['bersedia_vaksinasi_rutin']?></div>
                            </div>
                            <div class="p-2 row justify">
                                <div class="col-2">Bersedia Steril</div>
                                <div class="col-auto">:</div>
                                <div class="col-auto"><?= $data['bersedia_steril']?></div>
                            </div>
                            <div class="p-2 row justify">
                                <div class="col-2">Pernah Adopsi</div>
                                <div class="col-auto">:</div>
                                <div class="col-auto"><?= $data['pernah_adopsi']?></div>
                            </div>
                        </div>                        
                    </div>
                    <div class="tab-pane fade" id="foto-tab-pane" role="tabpanel" aria-labelledby="foto-tab" tabindex="0">
                        <div class="row" data-toggle="modal" data-target="#zoomFoto" style="margin-top: 20px;">
                            <div class="col-6 col-lg-3">
                                <div class="count-data text-center">
                                <img src="<?= base_url('/verifikasi').'/'.$data['foto_dirirumah']?>" title="" alt="" width="200px" height="200px" data-target="#carouselExample" data-slide-to="0">
                                </div>
                            </div>
                            <div class="col-6 col-lg-3">
                                <div class="count-data text-center">
                                <img src="<?= base_url('/verifikasi').'/'.$data['foto_rumah']?>" title="" alt="" width="200px" height="200px" data-target="#carouselExample" data-slide-to="1">
                                </div>
                            </div>
                            <div class="col-6 col-lg-3">
                                <div class="count-data text-center">
                                <img src="<?= base_url('/verifikasi').'/'.$data['foto_rumah2']?>" title="" alt="" width="200px" height="200px" data-target="#carouselExample" data-slide-to="2">
                                </div>
                            </div>
                            <div class="col-6 col-lg-3">
                                <div class="count-data text-center">
                                <img src="<?= base_url('/verifikasi').'/'.$data['foto_kandang']?>" title="" alt="" width="200px" height="200px" data-target="#carouselExample" data-slide-to="3">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>          
            </div>
            <div class="modal fade" id="zoomFoto" tabindex="-1" role="dialog" aria-hidden="true">
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
                            <img class="d-block w-100" src="<?= base_url('/verifikasi').'/'.$data['foto_dirirumah']?>" alt="foto diri">
                            </div>
                            <div class="carousel-item">
                            <img class="d-block w-100" src="<?= base_url('/verifikasi').'/'.$data['foto_rumah']?>" alt="foto rumah">
                            </div>
                            <div class="carousel-item">
                            <img class="d-block w-100" src="<?= base_url('/verifikasi').'/'.$data['foto_rumah2']?>" alt="foto rumah">
                            </div>
                            <div class="carousel-item">
                            <img class="d-block w-100" src="<?= base_url('/verifikasi').'/'.$data['foto_kandang']?>" alt="foto kandang">
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
            <div class="modal fade" tabindex="-1" role="dialog" id="terima">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Terima Submit Verifikasi?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>No ID Verifikasi: <?= $data['id_verifikasi']?> dengan nama lengkap <?=  $data['nama_lengkap']?> akan diterima dan menjadi akun terverifikasi?</p>
                        </div>
                        <div class="modal-footer" >
                            <div class="col">
                            <button type="button" class="btn btn-secondary btn-user btn-block" data-dismiss="modal" >
                                <span aria-hidden="true">Batal</span>
                            </button>
                            </div>
                            <div class="col">
                                <?= form_open('/admin/veriflanjut/terima')?>
                                    <button class="btn btn-success btn-user btn-block" name="id_verifikasi" value="<?= $data['id_verifikasi']?>">Simpan</button>
                                    <input type="text" disabled hidden name="id_member" value="<?= $data['id_member']?>">
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
                            <h5 class="modal-title">Tolak Submit Verifikasi?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>No ID Verifikasi: <?= $data['id_verifikasi']?> dengan nama lengkap <?=  $data['nama_lengkap']?> akan ditolak?</p>
                        </div>
                        <div class="modal-footer" >
                            <div class="col">
                            <button type="button" class="btn btn-secondary btn-user btn-block" data-dismiss="modal" >
                                <span aria-hidden="true">Batal</span>
                            </button>
                            </div>
                            <div class="col">
                                <?= form_open('/admin/veriflanjut/tolak')?>
                                    <button class="btn btn-success btn-user btn-block" name="id_verifikasi" value="<?= $data['id_verifikasi']?>">Simpan</button>
                                    <input type="text" disabled hidden name="id_member" value="<?= $data['id_member']?>">
                                <?= form_close()?>
                            </div>
                            
                        </div>
                    </div>
                </div>
        
            </div>
        </div>
    </section>
<?= $this->endSection();?>

