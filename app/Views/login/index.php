<?= $this->extend('/login/statis')?>
<?= $this->section('content')?>
<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <?= form_open('login/cekUser');?>
                                    <?= csrf_field();?>
                                    <div>
                                        <?php 
                                            // if (session()->getFlashdata('errEmail')||session()->getFlashdata('errPassword')) {
                                            //    $is_invalid = 'is-invalid';
                                            // } else {
                                            //     $is_invalid = '';
                                            // }
                                            $is_invalid=(session()->getFlashdata('errEmail')||session()->getFlashdata('errPassword')) ? 'is-invalid':'';
                                        ?>
                                        <?php
                                            if (session()->getFlashdata('berhasil')) {
                                                echo '<div class="alert alert-success" role="alert">'
                                                .session()->getFlashdata('berhasil').
                                              '</div>';
                                            }
                                        ?>
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user <?= $is_invalid?>"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                            <?php if (session()->getFlashdata('errEmail')) {
                                                echo '<div class="invalid-feedback">
                                                    '.session()->getFlashdata('errEmail').'
                                              </div>';
                                            }; ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user <?= $is_invalid?>"
                                                id="exampleInputPassword" placeholder="Password">
                                            <?php if (session()->getFlashdata('errPassword')) {
                                                echo '<div class="invalid-feedback">
                                                    '.session()->getFlashdata('errPassword').'
                                              </div>';
                                            }; ?>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <button name="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </div>
                                    <?= form_close();?>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="/login/forgot">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="/login/register">Create an Account!</a>
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