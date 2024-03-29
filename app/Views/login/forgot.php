<?= $this->extend('/login/statis')?>
<?= $this->section('content')?>
<div class="container">

<!-- Outer Row -->
<div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                                <p class="mb-4"><?php 
                                if (session()->getFlashdata('errEmail')) {
                                    echo '<div class="alert alert-danger" role="alert">'.session()->getFlashdata('errEmail').'
                                  </div>';
                                }elseif (session()->getFlashdata('pesan')) {
                                    echo '<div class="alert alert-success" role="success">'.session()->getFlashdata('pesan').'
                                    </div>';
                                }else {
                                    echo "We get it, stuff happens. Just enter your email address below
                                    and we'll send you a link to reset your password!";
                                }
                                ?></p>
                            </div>
                            <?= form_open('login/forgot/cekEmail')?>
                            <?= csrf_field()?>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user"
                                        id="exampleInputEmail" aria-describedby="emailHelp" name="email"
                                        placeholder="Enter Email Address...">
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block"> Reset Password</button>
                            <?= form_close()?>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="/login/register">Create an Account!</a>
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

</div>

</div>
<?= $this->endSection();?>