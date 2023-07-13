<?= $this->extend('main') ?>
<?= $this->section('content') ?>

<body>
    <div id="layout-wrapper">
        <div class="app-menu navbar-menu">
            <?php echo view('sidenavbar'); ?>
            <div class="sidebar-background"></div>
        </div>
    </div>
    <div class="vertical-overlay"></div>
    <div class="mt-5"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card card-animate">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="flex-grow-1">
                                <p class="text-uppercase fw-medium text-muted text-truncate fs-13">
                                    Total Product</p>
                                <h4 class="fs-22 fw-semibold mb-3"> <?php echo $productCount; ?></h4>
                                <div class="d-flex align-items-center gap-2">
                                    <?php if ($productPercentage > 0) { ?>
                                        <h5 class="text-success fs-12 mb-0">
                                            <i class="ri-arrow-right-up-line fs-13 align-middle"></i>
                                            +<?php echo number_format($productPercentage, 2); ?>%
                                        </h5>
                                    <?php } else if ($productPercentage < 0) { ?>
                                        <h5 class="text-danger fs-12 mb-0">
                                            <i class="ri-arrow-right-down-line fs-13 align-middle text-danger"></i>
                                            <?php echo number_format($productPercentage, 2); ?>%
                                        </h5>
                                    <?php } else { ?>
                                        <h5 class="text-muted fs-12 mb-0">
                                            No Change
                                        </h5>
                                    <?php } ?>
                                    <p class="text-muted mb-0">than last week</p>
                                </div>
                            </div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title <?php echo $productPercentage > 0 ? 'bg-success-subtle' : 'bg-danger-subtle'; ?> rounded fs-3">
                                    <i class="bx bx-dollar-circle <?php echo $productPercentage > 0 ? 'text-success' : 'text-danger'; ?>"></i>
                                </span>
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-animate">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="flex-grow-1">
                                <p class="text-uppercase fw-medium text-muted text-truncate fs-13">
                                    Total Category</p>
                                <h4 class="fs-22 fw-semibold mb-3"> <?php echo $categoryCount; ?></h4>
                                <div class="d-flex align-items-center gap-2">
                                    <?php if ($categoryPercentage > 0) { ?>
                                        <h5 class="text-success fs-12 mb-0">
                                            <i class="ri-arrow-right-up-line fs-13 align-middle"></i>
                                            +<?php echo number_format($categoryPercentage, 2); ?>%
                                        </h5>
                                    <?php } else if ($categoryPercentage < 0) { ?>
                                        <h5 class="text-danger fs-12 mb-0">
                                            <i class="ri-arrow-right-down-line fs-13 align-middle text-danger"></i>
                                            <?php echo number_format($categoryPercentage, 2); ?>%
                                        </h5>
                                    <?php } else { ?>
                                        <h5 class="text-muted fs-12 mb-0">
                                            No Change
                                        </h5>
                                    <?php } ?>
                                    <p class="text-muted mb-0">than last week</p>
                                </div>
                            </div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title <?php echo $categoryPercentage > 0 ? 'bg-success-subtle' : 'bg-danger-subtle'; ?> rounded fs-3">
                                    <i class="bx bx-dollar-circle <?php echo $categoryPercentage > 0 ? 'text-success' : 'text-danger'; ?>"></i>
                                </span>
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-animate">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="flex-grow-1">
                                <p class="text-uppercase fw-medium text-muted text-truncate fs-13">
                                    Total Admin</p>
                                <h4 class="fs-22 fw-semibold mb-3"> <?php echo $totalAdminsCount; ?></h4>
                                <div class="d-flex align-items-center gap-2">
                                    <?php if ($AdminsPercentage > 0) { ?>
                                        <h5 class="text-success fs-12 mb-0">
                                            <i class="ri-arrow-right-up-line fs-13 align-middle"></i>
                                            +<?php echo number_format($AdminsPercentage, 2); ?>%
                                        </h5>
                                    <?php } else if ($AdminsPercentage < 0) { ?>
                                        <h5 class="text-danger fs-12 mb-0">
                                            <i class="ri-arrow-right-down-line fs-13 align-middle text-danger"></i>
                                            <?php echo number_format($AdminsPercentage, 2); ?>%
                                        </h5>
                                    <?php } else { ?>
                                        <h5 class="text-muted fs-12 mb-0">
                                            No Change
                                        </h5>
                                    <?php } ?>
                                    <p class="text-muted mb-0">than last week</p>
                                </div>
                            </div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title <?php echo $AdminsPercentage > 0 ? 'bg-success-subtle' : 'bg-danger-subtle'; ?> rounded fs-3">
                                    <i class="bx bx-dollar-circle <?php echo $AdminsPercentage > 0 ? 'text-success' : 'text-danger'; ?>"></i>
                                </span>
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div>
            </div> 
        </div>
    </div>
    </div>
    <?php echo view('footer'); ?>  
</body>
<?= $this->endSection() ?>