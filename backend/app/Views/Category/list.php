<?= $this->extend('main') ?>
<?= $this->section('content') ?> 

<div class="col-12">
    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-sm-0">Datatables</h4>
        <div class="page-title-right">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategory">Add</button>
        </div>
        <div id="addCategory" class="modal fade" tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 overflow-hidden">
                    <div class="modal-header p-3">
                        <h4 class="card-title mb-0">Add Category</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- <form id="addCategoryForm" enctype="multipart/form-data"> -->
                        <form id="addCategoryForm" name="categorystore" action="<?php echo site_url('categorystore'); ?>" method=" post" enctype="multipart/form-data">

                            <div class="mb-3">
                                <label for="categoryname" class="form-label">Category Name</label>
                                <input type="text" class="form-control" id="categoryname" name="categoryname" placeholder="Enter your Category Name">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <input type="text" class="form-control" id="description" name="description" placeholder="Description">
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Sign Up Now</button>
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
                        <form action="category/update" name="updateCategory" id="updateCategory" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" id="id" />
                            <div class="mb-3">
                                <label for="categoryname" class="form-label">Category Name</label>
                                <input type="text" class="form-control" id="categoryname" name="categoryname" placeholder="Enter your Category Name">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <input type="text" class="form-control" id="description" name="description" placeholder="Description">
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Current Image</label>
                                <img id="currentImage" src="" alt="Current Image" width="100px" height="100px">
                            </div>
                            <div class="mb-3">
                                <label for="newImage" class="form-label">New Image</label>
                                <input type="file" class="form-control" id="newImage" name="image" accept="image/*">
                            </div>
                            <div class="text-end">
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


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Basic Datatables</h5>
            </div>
            <div class="card-body">
                <table id="adminTable" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 10px;">
                                <div class="form-check">
                                    <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
                                </div>
                            </th>
                            <th data-ordering="false">ID</th>
                            <th data-ordering="false">Name</th>
                            <th>Image</th>
                            <th>Description</th> 
                            <th>Create Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($Category as $row) : ?>
                            <tr>
                                <th scope="row">
                                    <div class="form-check">
                                        <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                    </div>
                                </th>
                                <td><?= $row['id']; ?></td>
                                <td><?= $row['categoryname']; ?></td>
                                <td><img src="<?= base_url('/uploads/' . $row['image']) ?>" alt="Category Image" width="100px" height="100px"></td>
                                <td><?= $row['description']; ?></td> 
                                <td><?= $row['created_at']; ?></td>
                                <td>
                                    <a data-id="<?php echo $row['id']; ?>" class="btn btn-primary btnEdit" id="">Edit</a>
                                    <a data-id="<?= $row['id']; ?>" class="btn btn-danger btnDelete">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div><!--end col-->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
<script>
    $(document).ready(function() {
        $('#addCategoryForm').submit(function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: '/categorystore',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    if (response.status === true) {
                        Swal.fire('Success', 'Category added successfully', 'success').then(function() {
                            $('#addCategory').modal('hide');
                            $('#addCategoryForm')[0].reset();

                            var newRow = '<tr>' +
                                '<th scope="row">' +
                                '<div class="form-check">' +
                                '<input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">' +
                                '</div>' +
                                '</th>' +
                                '<td>' + response.data.id + '</td>' +
                                '<td>' + response.data.categoryname + '</td>' +
                                '<td><img src="<?= base_url() ?>/uploads/' + response.data.image + '" alt="Category Image" width="100px" height="100px"></td>' +
                                '<td>' + response.data.description + '</td>' +
                                '<td>' + response.data.star + '</td>' +
                                '<td>' + response.data.created_at + '</td>' +
                                '<td>' +
                                '<a data-id="' + response.data.id + '" class="btn btn-primary btnEdit">Edit</a>' +
                                '<a data-id="' + response.data.id + '" class="btn btn-danger btnDelete">Delete</a>' +
                                '</td>' +
                                '</tr>';

                            $('#adminTable tbody').append(newRow);
                        });
                    } else {
                        var errors = res.errors;
                        var errorMessage = '';
                        for (var key in errors) {
                            errorMessage += errors[key] + '<br>';
                        }
                        Swal.fire('Error', errorMessage, 'error');
                    }
                },
                error: function() {
                    Swal.fire('Error', 'Failed to add category55', 'error');
                }
            });
        });

        $('body').on('click', '.btnDelete', function() {
            var categoryRow = $(this).closest('tr');
            var categoryId = $(this).attr('data-id');

            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this category!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then(function(result) {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'category/delete/' + categoryId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === true) {
                                categoryRow.remove();
                                Swal.fire('Success', response.message, 'success');
                            } else {
                                Swal.fire('Error', response.message, 'error');
                            }
                        },
                        error: function() {
                            Swal.fire('Error', 'Failed to delete category', 'error');
                        }
                    });
                }
            });
        });
    });
    $('body').on('click', '.btnEdit', function() {
        var category_id = $(this).attr('data-id');
        $.ajax({
            url: 'category/edit/' + category_id,
            type: "GET",
            dataType: 'json',
            success: function(res) {
                $('#updateModal').modal('show');
                $('#updateCategory #id').val(res.data.id);
                $('#updateCategory #categoryname').val(res.data.categoryname);
                $('#updateCategory #description').val(res.data.description);
                $('#updateCategory #image').val(res.data.image);
                $('#currentImage').attr('src', '/uploads/' + res.data.image);
            },
            error: function(data) {}
        });

        $('#updateCategory').submit(function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: 'category/update',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    if (response.status === true) {
                        Swal.fire('Success', response.message, 'success').then(function() {
                            $('#updateModal').modal('hide');
                            // Perform any necessary UI updates or refresh the page
                        });
                    } else {
                        var errors = response.errors;
                        var errorMessage = '';
                        for (var key in errors) {
                            errorMessage += errors[key] + '<br>';
                        }
                        Swal.fire('Error', errorMessage, 'error');
                    }
                },
                error: function() {
                    Swal.fire('Error', 'Failed to update category', 'error');
                }
            });
        });
    });
</script>
<?= $this->endSection() ?>