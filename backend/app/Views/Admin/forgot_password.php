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
                                    <div class="card-body px-0 p-sm-5 m-lg-4">
                                        <div class="text-center mt-2">
                                            <h5 class="text-primary fs-20">Forgot Password</h5>
                                            <p class="text-muted">Enter your registered email address to reset your password.</p>
                                        </div>
                                        <div class="p-2 mt-5">
                                            <form action="adminforgotpassword" method="POST">
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email" placeholder="Enter your email" name="email">
                                                </div>
                                                <div class="mt-4">
                                                    <button class="btn btn-primary w-100" type="submit">Reset Password</button>
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
