<?= $this->extend('main') ?>
<?= $this->section('content') ?>
<section class="auth-page-wrapper py-5 position-relative d-flex align-items-center justify-content-center min-vh-100 bg-light">
    <div class="container">
        <?php if (isset($validation)) : ?>
            <div class="alert alert-warning">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success">
                <?php echo session()->getFlashdata('success'); ?>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger">
                <?php echo session()->getFlashdata('error'); ?>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row g-0">
                            <div class="col-lg-12">
                                <div class="card mb-0 border-0 shadow-none">
                                    <div class="card-body px-0p-sm-5 m-lg-4">
                                        <div class="text-center mt-2">
                                            <h5 class="text-primary fs-20">Set New Password</h5>
                                            <p class="text-muted">Enter your email, OTP, and new password to set a new password for your account.</p>
                                        </div>
                                        <div class="p-2 mt-5">
                                            <form action="setnewpassword" method="POST">
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email" placeholder="Enter your email" name="email">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="otp" class="form-label">OTP</label>
                                                    <input type="text" class="form-control" id="otp" placeholder="Enter OTP" name="otp">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="password-input">Password</label>
                                                    <div class="position-relative auth-pass-inputgroup">
                                                        <input type="password" class="form-control pe-5 password-input" onpaste="return false" placeholder="Enter password" id="password-input" aria-describedby="passwordInput" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" name="password" required>
                                                        <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                                        <div class="invalid-feedback">
                                                            Please enter password
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="password-contain" class="p-3 bg-light mb-2 rounded">
                                                    <h5 class="fs-13">Password must contain:</h5>
                                                    <p id="pass-length" class="invalid fs-12 mb-2">Minimum <b>8
                                                            characters</b></p>
                                                    <p id="pass-lower" class="invalid fs-12 mb-2">At
                                                        <b>lowercase</b> letter (a-z)
                                                    </p>
                                                    <p id="pass-upper" class="invalid fs-12 mb-2">At least
                                                        <b>uppercase</b> letter (A-Z)
                                                    </p>
                                                    <p id="pass-number" class="invalid fs-12 mb-0">A least
                                                        <b>number</b> (0-9)
                                                    </p>
                                                </div>

                                                <div class="mt-4">
                                                    <button class="btn btn-primary w-100" type="submit">Set New Password</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="mt-4 text-center">
                                            <p class="mb-0">Remember your password? <a href="<?= base_url('adminsignin') ?>" class="fw-semibold text-primary text-decoration-underline">Sign In</a></p>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div>
                        </div><!--end row-->
                    </div>
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</section>
<?= $this->endSection() ?>