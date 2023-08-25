<?= $this->extend('main') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-10">
                        <h2 class="card-title mb-0 alert ">USER LIST</h2>
                    </div>
                    <div class="col-2">
                        <h2 class="card-title mb-0 text-center alert btnAdd">ADD USER</h2>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped" id="adminTable">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th  >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($user as $row) {
                        ?>
                            <tr id="<?php echo $row['id']; ?>">
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td>
                                    <a data-id="<?php echo $row['id']; ?>" class="btn btn-primary btnEdit" id="">Edit</a>
                                    <a data-id="<?php echo $row['id']; ?>" class="btn btn-danger btnDelete" id="">Delete</a>
                                    <a data-id="<?php echo $row['id']; ?>" class="btn btn-warning btnChangePassword" id="">Change Password</a>
                                     <a data-id="<?php echo $row['id']; ?>" class="btn btn-success btnLogin">Login</a> 
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div><!--end col-->
    </div><!--end row-->
</div> 
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addAdminForm" name="addAdminForm" action="<?= site_url('adminsignup'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" placeholder="Enter First Name" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" placeholder="Enter Last Name" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input class="form-control" id="password" name="password" type="password" placeholder="Enter Password" required>
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="updatePasswordModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Update Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updatePassword" name="updatePassword" action="<?php echo site_url('changepassword'); ?>" method="post">
                <div class="modal-body">
                    <input type="hidden" name="adminId" id="adminId">
                    <div class="form-group">
                        <label for="currentPassword">Old Password</label>
                        <input type="password" class="form-control" id="currentPassword" placeholder="Enter Old Password" name="current_password" required>
                    </div>
                    <div class="form-group">
                        <label for="newPassword">New Password</label>
                        <input type="password" class="form-control" id="newPassword" placeholder="Enter New Password" name="new_password">
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirm Password</label>
                        <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm New Password" name="confirm_password" required>
                    </div>
                </div>
                <div id="password-contain" class="p-3 bg-light mb-2 rounded">
                    <h5 class="fs-13">Password must contain:</h5>
                    <p id="pass-length" class="invalid fs-12 mb-2">Minimum <b>8 characters</b></p>
                    <p id="pass-lower" class="invalid fs-12 mb-2">At <b>lowercase</b> letter (a-z)</p>
                    <p id="pass-upper" class="invalid fs-12 mb-2">At least <b>uppercase</b> letter (A-Z)</p>
                    <p id="pass-number" class="invalid fs-12 mb-0">A least <b>number</b> (0-9)</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btnChangePassword">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Your content -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('#adminTable').DataTable();
        $('body').on('click', '.btnAdd', function() {
            $('#addModal').modal('show');
        });
        $("#addAdminForm").validate({ 
            rules: {
                username: "required",
                email: {
                    required: true,
                    email: true
                },
                password: "required"
            },
            messages: {},
            submitHandler: function(form) {
                $.ajax({
                    url: $(form).attr("action"),
                    type: "POST",
                    data: $(form).serialize(),
                    dataType: 'json',
                    success: function(res) {
                        if (res.status === true) {
                            var admin = '<tr id="' + res.data.id + '">';
                            admin += '<td>' + res.data.id + '</td>';
                            admin += '<td>' + res.data.username + '</td>';
                            admin += '<td>' + res.data.email + '</td>';
                            admin += '<td><a data-id="' + res.data.id + '" class="btn btn-primary btnEdit">Edit</a>  <a data-id="' + res.data.id + '" class="btn btn-danger btnDelete">Delete</a> <a data-id="' + res.data.id + '" class="btn btn-warning btnChangePassword">Change Password</a></td>';
                            admin += '</tr>';
                            $('#adminTable tbody').prepend(admin);

                            $('#addAdminForm')[0].reset();
                            $('#addModal').modal('hide');

                            Swal.fire('Success', 'Admin record added successfully', 'success');
                        } else {
                            // Show error message using SweetAlert
                            var errors = res.errors;
                            var errorMessage = '';
                            for (var key in errors) {
                                errorMessage += errors[key] + '<br>';
                            }
                            Swal.fire('Error', errorMessage, 'error');
                        }
                    },
                    error: function(data) {
                        Swal.fire('Error', 'Failed to add admin record', 'error');
                    }
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
                            admin += '<td><a data-id="' + res.data.id + '" class="btn btn-primary btnEdit">Edit</a>  <a data-id="' + res.data.id + '" class="btn btn-danger btnDelete">Delete</a> <a data-id="' + res.data.id + '" class="btn btn-warning btnChangePassword">Change Password</a></td>';
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

        $('body').on('click', '.btnChangePassword', function() {
            var admin_id = $(this).attr('data-id');
            $.ajax({
                url: 'admin/edit/' + admin_id,
                type: "GET",
                dataType: 'json',
                success: function(res) {
                    $('#updatePasswordModal').modal('show');
                    $('#updatePasswordModal #adminId').val(res.data.id);
                },
                error: function(data) {}
            });
        });

        $("#updatePassword").validate({
            rules: {
                current_password: "required",
                new_password: "required",
            },
            submitHandler: function(form) {
                var form_action = $("#updatePassword").attr("action");
                $.ajax({
                    data: $('#updatePassword').serialize(),
                    url: form_action,
                    type: "POST",
                    dataType: 'json',
                    success: function(res) {
                        if (res.status === true) {
                            $('#updatePasswordModal').modal('hide');
                            $('#updatePassword')[0].reset();
                            Swal.fire('Success', 'Password has been updated successfully.', 'success');
                        } else {
                            var errors = res.message; // Access the error message
                            Swal.fire('Error', errors, 'error');
                        }
                    },
                    error: function(data) {
                        Swal.fire('Error', 'Failed to update password.', 'error');
                    }
                });
            }

        });

        $(".btnLogin").click(function () {
            var userId = $(this).data("id");
            alert(userId)
            $.ajax({
                type: "POST",
                url: "userlogin", 
                data: { id: userId },
                success: function (response) {
                    window.location.href = 'orders';  
                     console.log(response); 
                },
                error: function (xhr, status, error) {
                    console.error(error);
                    alert("error")
                }
            });
        });

    });
</script>
<?= $this->endSection() ?>