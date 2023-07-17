<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>Sign Up | Hybrix - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Minimal Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="/assets/images/favicon.ico">

    <!-- Layout config Js -->
    <script src="/assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="/assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="/assets/css/custom.min.css" rel="stylesheet" type="text/css" />

</head>

<body>

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
</section>     <!-- JAVASCRIPT -->
    <script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="/assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="/assets/js/plugins.js"></script>

    <!-- validation init -->
    <script src="/assets/js/pages/form-validation.init.js"></script>
    <!-- password create init -->
    <script src="/assets/js/pages/passowrd-create.init.js"></script>

</body>

</html>