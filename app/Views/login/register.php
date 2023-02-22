<?= $this->extend('/login/statis')?>
<?= $this->section('content')?>
<div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <?= form_open('login/register/cekRegis');?>
                            <?= csrf_field(); ?>
                            <div>
                                 <?php 
                                    $is_invalid='';
                                            //$is_invalid=(session()->getFlashdata('errEmail')||session()->getFlashdata('errPassword')||session()->getFlashdata('errUsername')||session()->getFlashdata('errPasswordCon')||session()->getFlashdata('errNo_hp')) ? 'is-invalid':'';
                                ?>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user <?= $is_invalid=(session()->getFlashdata('errUsername'))? 'is-invalid':''?>" name="username" id="nama" placeholder="Nama" value="<?= session()->getFlashdata('username')?>" required>
                                    <?php if (session()->getFlashdata('errUsername')) {
                                                echo '<div class="invalid-feedback">'.session()->getFlashdata('errUsername').'</div>';
                                            }; ?>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user <?= $is_invalid=(session()->getFlashdata('errEmail'))? 'is-invalid':''?>" name="email" id="email"
                                        placeholder="Email Address" value="<?= session()->getFlashdata('email')?>" required>
                                    <?php if (session()->getFlashdata('errEmail')) {
                                                echo '<div class="invalid-feedback">
                                                    '.session()->getFlashdata('errEmail').'
                                              </div>';
                                            }; ?>    
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user <?= $is_invalid=(session()->getFlashdata('errPassword'))? 'is-invalid':''?>" name="password"
                                            id="password" placeholder="Password" required>
                                        <?php if (session()->getFlashdata('errPassword')) {
                                                echo '<div class="invalid-feedback">
                                                    '.session()->getFlashdata('errPassword').'
                                              </div>';
                                            }; ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user <?= $is_invalid=(session()->getFlashdata('errPasswordCon'))? 'is-invalid':''?>" name="passwordCon"
                                            id="repeatPassword" placeholder="Repeat Password" required>
                                        <?php if (session()->getFlashdata('errPasswordCon')) {
                                                echo '<div class="invalid-feedback">
                                                    '.session()->getFlashdata('errPasswordCon').'
                                              </div>';
                                           }; ?>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-2">
                                        <input type="text" name="" id="" class="form-control form-control-user" placeholder="+62" disabled>           
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-user <?= $is_invalid=(session()->getFlashdata('errNo_hp'))? 'is-invalid':''?>" name="no_hp" id="exampleInputPassword" placeholder="8000000001" value="<?= session()->getFlashdata('no_hp')?>" required maxlength="12" pattern="[0-9].{10,}" title="Mohon masukkan nomer sesuai contoh">
                                        <?php if (session()->getFlashdata('errNo_hp')) {
                                                    echo '<div class="invalid-feedback">
                                                        '.session()->getFlashdata('errNo_hp').'
                                                </div>';
                                                }; ?>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Register
                                </button>
                            </div>
                            <?= form_close()?>
                            <hr>    
                            <div class="text-center">
                                <a class="small" href="/login/forgot">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="/login">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
<?= $this->endSection();?>