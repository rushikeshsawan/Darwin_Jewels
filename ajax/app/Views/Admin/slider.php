<?= $this->extend('main') ?>
<?= $this->section('content') ?>
<div class="col-12">
    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-sm-0">Slider</h4>
        <div class="page-title-right">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSlider">Add</button>
        </div>
        <div id="addSlider" class="modal fade" tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 overflow-hidden">
                    <div class="modal-header p-3">
                        <h4 class="card-title mb-0">Add Slider</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addSliderForm" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="main_heading" class="form-label">Main heading</label>
                                <input type="text" class="form-control" id="main_heading" name="main_heading" placeholder="Enter your main heading">
                            </div>
                            <div class="mb-3">
                                <label for="sub_heading" class="form-label">Sub Heading</label>
                                <input type="text" class="form-control" id="sub_heading" name="sub_heading" placeholder="sub Heading">
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
                        <form action="category/update" name="updateSlider" id="updateSlider" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" id="id" />
                            <div class="mb-3">
                                <label for="main_heading" class="form-label">Category Name</label>
                                <input type="text" class="form-control" id="main_heading" name="main_heading" placeholder="Enter your main_heading">
                            </div>
                            <div class="mb-3">
                                <label for="sub_heading" class="form-label">sub_heading</label>
                                <input type="text" class="form-control" id="sub_heading" name="sub_heading" placeholder="sub_heading">
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
                            <th>sub_heading</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($slider as $row) : ?>
                            <tr>
                                <th scope="row">
                                    <div class="form-check">
                                        <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                    </div>
                                </th>
                                <td><?= $row['id']; ?></td>
                                <td><?= $row['main_heading']; ?></td>
                                <td><?= $row['sub_heading']; ?></td>
                                <td><img src="<?= base_url('/banner/' . $row['image']) ?>" alt="Category Image" width="100px" height="100px"></td>
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
        $('#addSliderForm').submit(function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: 'sliderstore',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    if (response.status === true) {
                        Swal.fire('Success', 'Slider added successfully', 'success').then(function() {
                            $('#addSlider').modal('hide');
                            console.log(response)
                            $('#addSliderForm')[0].reset();
                            var newRow = '<tr>' +
                                '<th scope="row">' +
                                '<div class="form-check">' +
                                '<input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">' +
                                '</div>' +
                                '</th>' +
                                '<td>' + response.data.id + '</td>' +
                                '<td>' + response.data.main_heading + '</td>' +
                                '<td>' + response.data.sub_heading + '</td>' +
                                '<td><img src="<?= base_url() ?>/banner/' + response.data.image + '" alt="Category Image" width="100px" height="100px"></td>' +
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
                error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Log the detailed error response
                    Swal.fire('Error', 'Failed to add slider.', 'error');
                }
            });
        });
        $('body').on('click', '.btnEdit', function() {
            var sliderID = $(this).attr('data-id');
            alert(sliderID)
            $.ajax({
                url: 'slideredit/' + sliderID,
                type: "GET",
                dataType: 'json',
                success: function(res) {
                    console.log(res)
                    $('#updateModal').modal('show');
                    $('#updateSlider #id').val(res.data.id);
                    $('#updateSlider #main_heading').val(res.data.main_heading);
                    $('#updateSlider #sub_heading').val(res.data.sub_heading);
                    $('#updateSlider #image').val(res.data.image);
                    $('#currentImage').attr('src', '/banner/' + res.data.image);
                },
                error: function(data) {
                    alert("sliderGet")
                }
            });

            $('#updateSlider').submit(function(event) {
                event.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: 'sliderupdate',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === true) {
                            Swal.fire('Success', response.message, 'success').then(function() {
                                $('#updateModal').modal('hide');
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
        $('body').on('click', '.btnDelete', function() {
            var categoryRow = $(this).closest('tr');
            var sliderID = $(this).attr('data-id');

            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this slider!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then(function(result) {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'sliderdelete/' + sliderID,
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
</script>


<?= $this->endSection() ?>