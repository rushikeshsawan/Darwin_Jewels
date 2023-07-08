<?= $this->extend('main') ?>
<?= $this->section('content') ?>

<body>
    <div id="layout-wrapper">
        <div class="app-menu navbar-menu">
            <?php echo view('sidenavbar'); ?>
            <div class="sidebar-background"></div>
        </div>
        <div class="vertical-overlay"></div>
        <div class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0 text-right"><a href="adminsignup">ADD</a></h5>
                            </div>
                            <div class="card-body">
                                <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 10px;">
                                                <div class="form-check">
                                                    <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
                                                </div>
                                            </th>
                                            <th>ID</th>
                                            <th>User Name</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($admin) : ?>
                                            <?php foreach ($admin as $user) : ?>
                                                <tr>
                                                    <th scope="row">
                                                        <div class="form-check">
                                                            <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                                        </div>
                                                    </th>
                                                    <td><?= $user['id']; ?></td>
                                                    <td><?= $user['username']; ?></td>
                                                    <td><?= $user['email']; ?></td>
                                                    <td>
                                                        <div class="dropdown d-inline-block">
                                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="ri-more-fill align-middle"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                -<li><a href="#!" class="dropdown-item"><i class="ri-eye-fill align-bottom me-2 textmuted"></i>
                                                                        View</a></li>
                                                                <li><a class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                        Edit</a></li>
                                                                <li>
                                                                    <a class="dropdown-item remove-item-btn">
                                                                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                        Delete
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
            </div>
            <?php echo view('footer'); ?>
        </div>
</body>
<?= $this->endSection() ?>