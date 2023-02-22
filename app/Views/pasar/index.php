<?= $this->extend('pasar/statis/gabungan'); ?>
<?= $this->section('contents'); ?>
    <!-- Section-->
    
        <div class="container px-4 px-lg-5 mt-5">
             <div class="row">
                    <?php 
                        if (session()->getFlashdata('alert')) {
                            echo '<p class="alert alert-danger">'.session()->getFlashdata('alert').'</p>';
                        }
                    ?>
            </div>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php 
                    foreach ($data as $key) {
                ?>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="<?=base_url()?>/hewan/<?= $key['foto']?>" alt="..." width="300px" height="200px"/>
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <?php if ($key['biaya_ganti']>0) {
                                        echo '<h5 class="fw-bolder">'.$key['nama_hewan'].'</h5>'.'
                                        Rp. '.$key['biaya_ganti'];
                                    } else {
                                        echo '<h5 class="fw-bolder">'.$key['nama_hewan'].'</h5>'.'Free Adopt';
                                    };?>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="/pasar/<?= $key['id_hewan']?>">Lihat Detail</a></div>
                            </div>
                        </div>
                    </div>
                <?php 
                 }
                ?>
            </div>
        </div>
    
<?= $this->endSection();?>