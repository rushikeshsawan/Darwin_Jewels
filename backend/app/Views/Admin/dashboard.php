<?= $this->extend('main') ?>
<?= $this->section('content') ?>

<body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                            <!-- Inside the main content section -->
                            <?php if (session()->getFlashdata('success')) : ?>
                                <div class="alert alert-success">
                                    <?= session()->getFlashdata('success') ?>
                                </div>
                            <?php endif; ?>

                            <?php if (session()->getFlashdata('error')) : ?>
                                <div class="alert alert-danger">
                                    <?= session()->getFlashdata('error') ?>
                                </div>
                            <?php endif; ?>

                            <?php if (session()->getTempdata('success')) : ?>
                                <div class="alert alert-success">
                                    <?php echo session()->getTempdata('success'); ?>
                                </div>
                            <?php endif; ?>
                            <div class="card-header">
                                <h5 class="card-title mb-0 text-right"><a data-bs-toggle="modal" data-bs-target="#addModal">ADD</a></h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped" id="adminTable">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Password</th>
                                            <th width="280px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($admin as $row) {
                                        ?>
                                            <tr id="<?php echo $row['id']; ?>">
                                                <td><?php echo $row['id']; ?></td>
                                                <td><?php echo $row['username']; ?></td>
                                                <td><?php echo $row['email']; ?></td>
                                                <td><?php echo $row['password']; ?></td>
                                                <td>
                                                    <a data-id="<?php echo $row['id']; ?>" class="btn btn-primary btnEdit" id="">Edit</a>
                                                    <a data-id="<?php echo $row['id']; ?>" class="btn btn-danger btnDelete" id="">Delete</a>
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
            <?php echo view('footer'); ?>
        </div>
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalLabel">Add New Admin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="addAdmin" name="addAdmin" action="<?php echo site_url('adminsignup'); ?>" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" placeholder="Enter First Name" name="username">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" placeholder="Enter Last Name" name="email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input class="form-control" id="password" name="password" rows="10" placeholder="Enter Address">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalLabel">Update Admin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="updateAdmin" name="updateAdmin" action="<?php echo site_url('admin/update'); ?>" method="post">
                        <div class="modal-body">
                            <input type="hidden" name="adminId" id="adminId" />
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" placeholder="Enter First Name" name="username">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" placeholder="Enter Last Name" name="email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <textarea class="form-control" id="password" name="password" rows="10" placeholder="Enter Address"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</body>
<script>
    $(document).ready(function() {
        $('#adminTable').DataTable();
        $("#addAdmin").validate({
            rules: {
                username: "required",
                email: "required",
                password: "required"
            },
            messages: {},
            submitHandler: function(form) {
                var form_action = $("#addAdmin").attr("action");
                $.ajax({
                    data: $('#addAdmin').serialize(),
                    url: form_action,
                    type: "POST",
                    dataType: 'json',
                    success: function(res) {
                        var admin = '<tr id="' + res.data.id + '">';
                        admin += '<td>' + res.data.id + '</td>';
                        admin += '<td>' + res.data.username + '</td>';
                        admin += '<td>' + res.data.email + '</td>';
                        admin += '<td>' + res.data.password + '</td>';
                        admin += '<td><a data-id="' + res.data.id + '" class="btn btn-primary btnEdit">Edit</a>  <a data-id="' + res.data.id + '" class="btn btn-danger btnDelete">Delete</a></td>';
                        admin += '</tr>';
                        $('#adminTable tbody').prepend(admin);
                        $('#adminTable tbody #' + res.data.id).html(admin);
                        $('#addAdmin')[0].reset();
                        $('#addModal').modal('hide');

                        // $('#adminTable tbody #'+ res.data.id).html(admin);
                        // $('#updateAdmin')[0].reset();
                        // $('#updateModal').modal('hide');
                    },
                    error: function(data) {}
                });
            }
        });

        $('body').on('click', '.btnEdit', function() {
            var admin_id = $(this).attr('data-id');
            $.ajax({
                url: 'admin/edit/' + admin_id,
                type: "GET",
                dataType: 'json',
                success: function(res) {
                    $('#updateModal').modal('show');
                    $('#updateAdmin #adminId').val(res.data.id);
                    $('#updateAdmin #username').val(res.data.username);
                    $('#updateAdmin #email').val(res.data.email);
                    $('#updateAdmin #password').val(res.data.password);
                },
                error: function(data) {}
            });
        });

        $("#updateAdmin").validate({
            rules: {
                username: "required",
                email: "required",
                password: "required"
            },
            messages: {},
            submitHandler: function(form) {
                var form_action = $("#updateAdmin").attr("action");
                $.ajax({
                    data: $('#updateAdmin').serialize(),
                    url: form_action,
                    type: "POST",
                    dataType: 'json',
                    success: function(res) {
                        if (res.status === true) {
                            var admin = '<td>' + res.data.id + '</td>';
                            admin += '<td>' + res.data.username + '</td>';
                            admin += '<td>' + res.data.email + '</td>';
                            admin += '<td>' + res.data.password + '</td>';
                            admin += '<td><a data-id="' + res.data.id + '" class="btn btn-primary btnEdit">Edit</a>  <a data-id="' + res.data.id + '" class="btn btn-danger btnDelete">Delete</a></td>';
                            $('#adminTable tbody #' + res.data.id).html(admin);
                            $('#updateAdmin')[0].reset();
                            $('#updateModal').modal('hide');

                            Swal.fire('Success', 'Admin record updated successfully', 'success');
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
                        Swal.fire('Error', 'Failed to update admin record', 'error');
                    }
                });
            }
        });




        $('body').on('click', '.btnDelete', function() {
            var admin_id = $(this).attr('data-id');
            $.ajax({
                url: 'admin/delete/' + admin_id,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    if (response.status === true) {
                        Swal.fire('Success', response.message, 'success');
                        $('#adminTable tbody #' + admin_id).remove();
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
<?= $this->endSection() ?>