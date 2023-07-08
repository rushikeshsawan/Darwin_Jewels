<?= $this->extend('main') ?>
<?= $this->section('content') ?>
<section class="auth-page-wrapper py-5 position-relative d-flex align-items-center justify-content-center min-vh-100 bg-light">
    <div class="container">
        <?php if (isset($validation)) : ?>
            <div class="alert alert-warning">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>
        <?php if (session()->getTempdata('success')) : ?>
            <div class="alert alert-success">
                <?php echo session()->getTempdata('success'); ?>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row g-0">
                            <div class="col-lg-5">
                                <div class="auth-card card bg-primary h-100 border-0 shadow-none p-sm-3 overflow-hidden">
                                </div>
                            </div><!--end col-->
                            <div class="col-lg-7">
                                <div class="card mb-0 border-0 py-3 shadow-none">
                                    <div class="card-body px-0 p-sm-5 m-lg-4">
                                        <div class="text-center mt-2">
                                            <h5 class="text-primary fs-20">Create New Account</h5>
                                            <p class="text-muted">Get your free Hybrix account now</p>
                                        </div>
                                        <div class="p-2 mt-5">
                                            <form class="needs-validation" novalidate action="adminsignup" id="signupForm" method="post">
                                                <div class="mb-3">
                                                    <label for="useremail" class="form-label">Email <span class="text-danger">*</span></label>
                                                    <input type="email" class="form-control" id="useremail" placeholder="Enter email address" name="email" required>
                                                    <div class="invalid-feedback">
                                                        Please enter email
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="username" placeholder="Enter username" name="username" required>
                                                    <div class="invalid-feedback">
                                                        Please enter username
                                                    </div>
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

                                                <div class="mb-4">
                                                    <p class="mb-0 fs-12 text-muted fst-italic">By registering you
                                                        agree to the Hybrix <a href="#" class="text-primary text-decoration-underline fst-normal fw-medium">Terms
                                                            of Use</a></p>
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
                                                    <button class="btn btn-primary w-100" type="submit">Sign
                                                        Up</button>
                                                </div>

                                                <div class="mt-4 text-center">
                                                    <div class="signin-other-title">
                                                        <h5 class="fs-13 mb-4 title text-muted">Create account with
                                                        </h5>
                                                    </div> 
                                                </div>
                                            </form>
                                        </div>
                                        <div class="mt-4 text-center">
                                            <p class="mb-0">Already have an account? 
                                                    Sign in </p>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!--end col-->
                        </div><!--end row-->
                    </div>
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
        </section>
<?= $this->endSection() ?> 