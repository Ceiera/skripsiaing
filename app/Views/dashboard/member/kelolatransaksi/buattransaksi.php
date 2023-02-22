<?= $this->extend('dashboard/statis/template');?>
<?= $this->section('content');?>
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class=""style="padding: 22px 20px; background: #ffffff; border-radius: 10px; box-shadow: 0 0 30px rgba(31, 45, 61, 0.125);">
            <div id="dataAdopsi">
                <h6>
                    <p>Anda akan melakukan pembayaran untuk adopsi</p>
                    <div class="row">
                        <div class="col-2">Nama Pemilik</div>
                        <div class="col-1">:</div>
                        <div class="col-auto"><?= $data['nama_lengkap']?></div>
                    </div>
                    <div class="row">
                        <div class="col-2">Nama Hewan</div>
                        <div class="col-1">:</div>
                        <div class="col-auto"><?= $data['nama_hewan']?></div>
                    </div>
                    <div class="row">
                        <div class="col-2">Jenis Hewan</div>
                        <div class="col-1">:</div>
                        <div class="col-auto"><?= $data['jenis_hewan']?></div>
                    </div>
                    <div class="row">
                        <div class="col-2">Biaya</div>
                        <div class="col-1">:</div>
                        <div class="col-auto">Rp.<?= $data['harga_diterima']?></div>
                    </div>
                    <br>
                    <p>silahkan melengkapi data dibawah ini</p>
                </h6>
                <div id="datalengkapi">
                    <div class="row">
                        <span class="col-2">Pilih Bank</span>
                        <br>
                        <div class="row">
                            <div class="col-2">
                                <input type="radio" class="btn-check" id="btncheck1" autocomplete="off" name="kode_bank" value="BNI">
                                <label class="btn btn-outline-primary" for="btncheck1"><img src="https://upload.wikimedia.org/wikipedia/id/5/55/BNI_logo.svg" width="60px" height="40px"></label>
                            </div>
                            <div class="col-2">
                                <input type="radio" class="btn-check" id="btncheck2" autocomplete="off" name="kode_bank" value="BCA">
                                <label class="btn btn-outline-primary" for="btncheck2"><img src="https://upload.wikimedia.org/wikipedia/commons/5/5c/Bank_Central_Asia.svg" width="60px" height="40px"></label>
                            </div>
                            <div class="col-2">
                                <input type="radio" class="btn-check" id="btncheck3" autocomplete="off" name="kode_bank" value="MANDIRI">
                                <label class="btn btn-outline-primary" for="btncheck3"><img src="https://upload.wikimedia.org/wikipedia/commons/a/ad/Bank_Mandiri_logo_2016.svg" width="60px" height="40px"></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <button class="btn btn-success" onclick="buatVA()">Klik coba</button>
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
                        <div class="modal-body" id="bodymodal">
                            <div>
                                <div class="row">
                                    <h6 class="col-4">BANK: </h4>
                                    <p class="col-auto" id="kode_bank_dibayar"></p>
                                </div>
                                <div class="row">
                                    <h6 class="col-4">Nomer VA: </h4>
                                    <p class="col-auto" id="nomer_va"></p>
                                </div>
                                <div class="row">
                                    <h6 class="col-4">Expired: </h4>
                                    <p class="col-auto" id="expiredate"></p>
                                </div>
                                <div class="row">
                                    <h6 class="col-4">Durasi: </h4>
                                    <p class="col-auto" id="timer"></p>
                                </div>
                                <div class="row">
                                    <h6 class="col-4">Status Pembayaran</h4>
                                    <p class="col-auto">: <span class="badge badge-warning" id="status_pembayaran">PENDING</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer" >
                            <div class="col">
                            <button type="button" class="btn btn-secondary btn-user btn-block" data-dismiss="modal">
                                <span aria-hidden="true">Close</span>
                            </button>
                            </div>
                            <div class="col">
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<script>
    function buatVA() {
        var kode_bank= $('input[name="kode_bank"]:checked').val(); 
        $.ajax({
            type: "POST",
            data: {kode_bank:kode_bank},
            url: "<?= base_url().'/dashboard/kelolatransaksi/buatVA'?>",
            success: function (response) {
                var data=JSON.parse(response);
                $('#kode_bank_dibayar').text(": "+data.bank_code);
                $('#nomer_va').text(": "+data.account_number);
                $('#expiredate').text(": "+moment(Date.parse(data.expiration_date)).format('D-MM-YYYY h:mm:ss'));
                timerExpired(data.expiration_date,"timer");
                refresh(data.id);
                $('#terima').modal('show');
            },
            error: function (xhr,ajaxOptions,thrownError) {
                alert(xhr.status + "\n"+ xhr.responseText + "\n"+thrownError);
            }
        });
        
    };
    function timerExpired(date,id) {
        var countDownDate = new Date(date).getTime();

          // Update the count down every 1 second
          var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the result in the element with id="demo"
            document.getElementById(id).innerHTML =": "+ days + "d " + hours + "h "
            + minutes + "m " + seconds + "s ";

            // If the count down is finished, write some text
            if (distance < 0) {
              clearInterval(x);
              document.getElementById(id).innerHTML = ": "+"EXPIRED";
            }
        }, 1000);      
    }
    function refresh(idakun) {
        var y = setInterval(function() {
            $.ajax({
                type: "POST",
                data: {id:idakun},
                url: "<?= base_url().'/dashboard/kelolatransaksi/cekPembayaran'?>",
                success: function (response) {
                    var update=JSON.parse(response);
                    if (update.status=="INACTIVE") {
                        $('#status_pembayaran').text('SUKSES');
                        $('#status_pembayaran').removeClass('badge-warning');
                        $('#status_pembayaran').addClass('badge-success');
                        clearInterval(x);
                        clearInterval(y);
                    }
                },
                error: function (xhr,ajaxOptions,thrownError) {
                alert(xhr.status + "\n"+ xhr.responseText + "\n"+thrownError);
            }
            });
        },3000);
    };
    function cekPembayaran() { 

    };
    
</script>
<?= $this->endSection();?>