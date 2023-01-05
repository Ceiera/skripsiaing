<?= $this->extend('pasar/statis/gabungan'); ?>
<?= $this->section('contents'); ?>
    <!-- Section-->
        <!-- Product section-->
        <?php foreach ($data as $key) {
            # code...
        ?>
        <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="<?= base_url()?>/hewan/<?= $key['foto']?>" alt="..." width="700px" height="600px"/></div>
                <div class="col-md-6">
                    <?= form_open('pasar/ajukanadopsi') ;?>
                    <?= csrf_field();?>
                    <div>
                        <div class="small mb-1"><?= $key['id_hewan']?></div>
                        <input type="text" hidden value="<?= $key['id_hewan']?>" name="id_hewan">
                        <input type="text" hidden name="biaya" value="<?= $key['id_hewan'];?>">                        
                    </div>
                    <input type="text" hidden name="pemilik" value="<?= $key['id_member'];?>">                        
                    <h1 class="display-5 fw-bolder"><?= $key['nama_hewan'];?></h1>
                    <div class="fs-5 mb-5">
                        <span>Rp. <?= $key['biaya_ganti'];?>,00-</span>
                        <input type="text" hidden name="biaya" value="<?= $key['biaya_ganti'];?>">
                    </div>
                    <p class="lead"><?= $key['kemampuan_khusus'] ;?></p>
                    <div class="d-flex">
                        <button class="btn btn-outline-dark flex-shrink-0" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Ajukan Adopsi
                        </button>
                    </div>
                    <?= form_close();?>
                </div>
            </div>
        </div>
        <?php };?>
<?= $this->endSection();?>