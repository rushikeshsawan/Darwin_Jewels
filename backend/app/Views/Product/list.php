<?= $this->extend('main') ?>
<?= $this->section('content') ?>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div id="layout-wrapper">
    <header id="page-topbar">
    </header>
    <div class="app-menu navbar-menu">
        <div class="navbar-brand-box">
            <a href="index.html" class="logo logo-dark">
                <span class="logo-sm">
                    <img src="assets/images/logo-sm.png" alt="" height="26">
                </span>
                <span class="logo-lg">
                    <img src="assets/images/logo-dark.png" alt="" height="26">
                </span>
            </a>
            <a href="index.html" class="logo logo-light">
                <span class="logo-sm">
                    <img src="assets/images/logo-sm.png" alt="" height="24">
                </span>
                <span class="logo-lg">
                    <img src="assets/images/logo-light.png" alt="" height="24">
                </span>
            </a>
            <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                <i class="ri-record-circle-line"></i>
            </button>
        </div>

        <div id="scrollbar">
            <?php echo view('sidenavbar'); ?>
        </div>

        <div class="back-btn">
            <a href="index.html" class="btn btn-primary p-0 avatar-sm rounded-circle" data-bs-toggle="tooltip" data-bs-title="Back to Dashboard">
                <div class="avatar-title rounded-circle">
                    <i class="bi bi-house-door-fill"></i>
                </div>
            </a>
        </div>

        <div class="sidebar-background"></div>
    </div>
    <div class="vertical-overlay"></div>
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Datatables</h4>
                            <div class="page-title-right">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategory">Click me</button>
                            </div>
                            <div id="addCategory" class="modal fade" tabindex="-1" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 overflow-hidden">
                                        <div class="modal-header p-3">
                                            <h4 class="card-title mb-0">Add Product</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="productstore" method="POST" enctype="multipart/form-data">

                                                <div class="mb-3">
                                                    <label for="product_name" class="form-label">Product Name</label>
                                                    <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter Your Product Name">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="categoryname" class="form-label">Category</label>
                                                    <select name="category_id" class="form-control" id="exampleFormControlSelect1">
                                                        <?php foreach ($categories as $category) : ?>
                                                            <option value="<?= $category['id'] ?>"><?= $category['categoryname'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="description" class="form-label">Description</label>
                                                    <input type="text" class="form-control" id="description" name="description" placeholder="Description">
                                                </div>
                                                <div class="text-end">
                                                    <button type="submit" class="btn btn-primary">SAVE
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div>
                            <div id="updateModal" class="modal fade" tabindex="-1" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 overflow-hidden">
                                        <div class="modal-header p-3">
                                            <h4 class="card-title mb-0">Sign Up</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form name="updateProduct" id="updateProduct" method="POST" action="<?php echo site_url('productupdate'); ?>" method="post">
                                                <input type=" " name="id" id="id" />
                                                <div class="mb-3">
                                                    <label for="categoryname" class="form-label">Product Name</label>
                                                    <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter your Category Name">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="description" class="form-label">Category</label>
                                                    <input type="text" class="form-control" id="category_id" name="category_id" placeholder="Description">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="description" class="form-label">Description</label>
                                                    <input type="text" class="form-control" id="description" name="description" placeholder="Description">
                                                </div>
                                                <div class="text-start">
                                                    <button type="submit" class="btn btn-primary">Update
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Basic Datatables</h5>
                            </div>
                            <div class="card-body">
                                <table id="productTable" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%"> 
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 10px;">
                                                <div class="form-check">
                                                    <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
                                                </div>
                                            </th>
                                            <th data-ordering="false">ID</th>
                                            <th data-ordering="false">Name</th>
                                            <th>Description</th>
                                            <th>Category</th>
                                            <th>Create Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($product as $row) {
                                        ?>
                                            <tr>
                                                <th scope="row">
                                                    <div class="form-check">
                                                        <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                                    </div>
                                                </th>
                                                <td><?= $row->id; ?></td>
                                                <td><?= $row->product_name; ?></td>
                                                <td><?= $row->description; ?></td>
                                                <td><?= $row->categoryname; ?></td>
                                                <td><?= $row->created_at; ?></td>
                                                <td>
                                                    <a data-id="<?= $row->id; ?>" class="btn btn-primary btnEdit" id="">Edit</a>
                                                    <a data-id="<?= $row->id; ?>" class="btn btn-danger btnDelete" id="">Delete</a>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
            </div>
        </div>
    </div>
  <script>
    $(document).ready(function() {
    $('#productTable').DataTable();

    $('body').on('click', '.btnEdit', function() {
        var product_id = $(this).attr('data-id');
        $.ajax({
            url: 'productedit/' + product_id,
            type: "GET",
            dataType: 'json',
            success: function(res) {
                $('#updateModal').modal('show');
                $('#updateProduct #id').val(res.data.id);
                $('#updateProduct #product_name').val(res.data.product_name);
                $('#updateProduct #category_id').val(res.data.category_id);
                $('#updateProduct #description').val(res.data.description);
            },
            error: function(data) {
                alert("Error");
            }
        });
    });

    $("#productTable").validate({
        rules: {
            product_name: "required",
            category_id: "required",
            description: "required"
        },
        messages: {},
        submitHandler: function(form) {
            var form_action = $("#productTable").attr("action");
            $.ajax({
                data: $('#productTable').serialize(),
                url: form_action,
                type: "POST",
                dataType: 'json',
                success: function(res) {
                    if (res.status === true) {
                        var product = '<td>' + res.data.id + '</td>';
                        product += '<td>' + res.data.product_name + '</td>';
                        product += '<td>' + res.data.category_id + '</td>';
                        product += '<td>' + res.data.description + '</td>';
                        product += '<td><a data-id="' + res.data.id + '" class="btn btn-primary btnEdit">Edit</a>  <a data-id="' + res.data.id + '" class="btn btn-danger btnDelete">Delete</a></td>';
                        $('#productTable tbody #' + res.data.id).html(product);
                        $('#productTable')[0].reset();
                        $('#updateModal').modal('hide');
                        Swal.fire('Success', 'Product record updated successfully', 'success');
                    } else {
                        var errors = res.errors;
                        var errorMessage = '';
                        for (var key in errors) {
                            errorMessage += errors[key] + '<br>';
                        }
                        Swal.fire('Error', errorMessage, 'error');
                    }
                },
                error: function(data) {
                    Swal.fire('Error', 'Failed to update product record', 'error');
                }
            });
        },
        errorPlacement: function(error, element) {
            // Show validation errors using SweetAlert
            Swal.fire('Error', error.text(), 'error');
        }
    });

    $('body').on('click', '.btnDelete', function() {
        var product_id = $(this).attr('data-id');
        $.ajax({
            url: 'productdelete/' + product_id,
            type: 'get',
            dataType: 'json',
            success: function(response) {
                if (response.status === true) {
                    Swal.fire('Success', response.message, 'success');
                    $('#productTable tbody #' + product_id).remove();
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            },
            error: function() {
                Swal.fire('Error', 'Failed to delete admin record', 'error');
            }
        });
    });
});

  </script>
    <?php echo view('footer'); ?>
    <?= $this->endSection() ?>