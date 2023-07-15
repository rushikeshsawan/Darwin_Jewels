<?= $this->extend('main') ?>
<?= $this->section('content') ?>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-bar-rating/1.2.2/jquery.barrating.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-bar-rating/1.2.2/themes/fontawesome-stars.min.css" rel="stylesheet">

<div id="layout-wrapper">
    <?php echo view('header'); ?>
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
                                            <form action="productstore" method="POST" id="productForm" enctype="multipart/form-data">
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
                                            <h4 class="card-title mb-0">Update Product</h4>
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
                                            <th>Rating</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="productTableBody">
                                        <?php foreach ($product as $row) : ?>
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
                                                    <div class="rating" data-product-id="<?= $row->id; ?>">
                                                        <input type="radio" id="star5_<?= $row->id; ?>" name="rating<?= $row->id; ?>" value="5" />
                                                        <label for="star5_<?= $row->id; ?>" title="5 stars"></label>
                                                        <input type="radio" id="star4_<?= $row->id; ?>" name="rating<?= $row->id; ?>" value="4" />
                                                        <label for="star4_<?= $row->id; ?>" title="4 stars"></label>
                                                        <input type="radio" id="star3_<?= $row->id; ?>" name="rating<?= $row->id; ?>" value="3" />
                                                        <label for="star3_<?= $row->id; ?>" title="3 stars"></label>
                                                        <input type="radio" id="star2_<?= $row->id; ?>" name="rating<?= $row->id; ?>" value="2" />
                                                        <label for="star2_<?= $row->id; ?>" title="2 stars"></label>
                                                        <input type="radio" id="star1_<?= $row->id; ?>" name="rating<?= $row->id; ?>" value="1" />
                                                        <label for="star1_<?= $row->id; ?>" title="1 star"></label>
                                                    </div>
                                                </td>

                                                <td>
                                                    <a data-id="<?= $row->id; ?>" class="btn btn-primary btnEdit" id="">Edit</a>
                                                    <a data-id="<?= $row->id; ?>" class="btn btn-danger btnDelete" id="">Delete</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
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
            $("#updateProduct").submit(function(e) {
                e.preventDefault();
                var form = $(this);
                var url = form.attr('action');
                var formData = form.serialize();

                $.ajax({
                    url: url,
                    type: "POST",
                    data: formData,
                    dataType: 'json',
                    success: function(res) {
                        if (res.status === true) {
                            var productId = res.data.id;
                            var tableRow = $('tr[data-product-id="' + productId + '"]');
                            tableRow.find('td:nth-child(3)').text(res.data.product_name);
                            tableRow.find('td:nth-child(4)').text(res.data.description);
                            tableRow.find('td:nth-child(5)').text(res.data.category_id);
                            $('#updateModal').modal('hide');
                            Swal.fire('Success', 'Product record updated successfully', 'success');
                        } else {
                            if (res.errors) {
                                var errorMessage = '';
                                $.each(res.errors, function(field, error) {
                                    errorMessage += error + '<br>';
                                });
                                Swal.fire('Validation Error', errorMessage, 'error');
                            } else {
                                Swal.fire('Error', 'Failed to update product record', 'error');
                            }
                        }
                    },
                    error: function() {
                        Swal.fire('Error', 'Failed to update product record', 'error');
                    }
                });
            });
            $('body').on('click', '.btnDelete', function() {
                var product_id = $(this).attr('data-id');
                var row = $(this).closest('tr');

                $.ajax({
                    url: 'productdelete/' + product_id,
                    type: 'get',
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === true) {
                            Swal.fire('Success', response.message, 'success');
                            row.remove();
                        } else {
                            Swal.fire('Error', response.message, 'error');
                        }
                    },
                    error: function() {
                        Swal.fire('Error', 'Failed to delete product record', 'error');
                    }
                });
            });
            $("#productForm").submit(function(e) {
                e.preventDefault(); // Prevent form submission

                var form = $(this);
                var url = form.attr('action');
                var formData = form.serialize();

                $.ajax({
                    url: url,
                    type: "POST",
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === true) {
                            var product = response.data;
                            $('#addCategory').modal('hide');
                            form[0].reset();
                            Swal.fire('Success', response.message, 'success');
                            var newRow = '<tr>' +
                                '<td><input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">+</td>' +
                                '<td>' + product.id + '</td>' +
                                '<td>' + product.product_name + '</td>' +
                                '<td>' + product.description + '</td>' +
                                '<td>' + product.categoryname + '</td>' +
                                '<td>' + product.created_at + '</td>' +
                                '<td>' +
                                '<a data-id="' + product.id + '" class="btn btn-primary btnEdit">Edit</a>' +
                                '<a data-id="' + product.id + '" class="btn btn-danger btnDelete">Delete</a>' +
                                '</td>' +
                                '</tr>';
                            $('#productTable tbody').append(newRow);
                        } else if (response.status === false) {
                            var errorMessage = response.message;
                            if (response.errors) {
                                errorMessage += '<br>' + Object.values(response.errors).join('<br>');
                            }
                            Swal.fire('Error', errorMessage, 'error');
                        }
                    },
                    error: function() {
                        Swal.fire('Error', 'Failed to add product', 'error');
                    }
                });
            });
            $('.rating').each(function() {
                var productId = $(this).data('product-id');
                var starRating = $(this);
                
                starRating.barrating({
                    theme: 'fontawesome-stars',
                    onSelect: function(value, text, event) {
                        $.ajax({
                            url: 'rating/store',
                            type: 'POST',
                            data: {
                                product_id: productId,
                                rating: value
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response.status === true) {
                                    // Rating stored successfully
                                    Swal.fire('Success', 'Rating stored successfully', 'success');
                                } else {
                                    Swal.fire('Error', 'Failed to store rating', 'error');
                                }
                            },
                            error: function() {
                                Swal.fire('Error', 'Failed to store rating', 'error');
                            }
                        });
                    }
                });
            });

        });
    </script>
    <?php echo view('footer'); ?>
    <?= $this->endSection() ?>