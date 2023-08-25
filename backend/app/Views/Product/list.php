<?= $this->extend('main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="row">
        <div class="col-md-10">
            <h5 class="card-title mb-0">Product Datatables</h5>
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">Add Product</button>
        </div>
    </div>
    <div class="card-body">
        <table id="productTable" class="table table-bordered dt-responsive nowrap table-striped align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Category ID</th>
                    <th>Rating</th>
                    <th>Prize</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

<!-- Add/Edit Product Modal -->

<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="productForm" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" id="productId" name="productId">
                    <div class="mb-3">
                        <label for="product_name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select name="category_id" class="form-control" id="category_id">
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?= $category['id'] ?>"><?= $category['categoryname'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="prize" class="form-label">Prize</label>
                        <input type="text" class="form-control" id="prize" name="prize" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image1" name="image1">
                    </div>
                    <div class="mb-3">
                        <label for="image2" class="form-label">Image 2</label>
                        <input type="file" class="form-control" id="image2" name="image2">
                    </div>
                    <div class="mb-3">
                        <label for="image3" class="form-label">Image 3</label>
                        <input type="file" class="form-control" id="image3" name="image3">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this product?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="deleteConfirmBtn">Delete</button>
            </div>
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= base_url('public/rateyo/jquery.rateyo.min.js') ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

<script>
    $(document).ready(function() {
        function updateProductTable() {
            $.ajax({
                url: "<?= base_url('product/getProductList'); ?>",
                type: "GET",
                dataType: "json",
                success: function(response) {
                    var productList = response.products;
                    var html = '';

                    for (var i = 0; i < productList.length; i++) {
                        html += '<tr>';
                        html += '<td>' + productList[i].id + '</td>';
                        html += '<td>' + productList[i].product_name + '</td>';
                        html += '<td>' + productList[i].categoryname + '</td>';
                        html += '<td>' + getStarRatingHtml(productList[i].rating) + '</td>';
                        html += '<td>' + productList[i].prize + '</td>';
                        html += '<td><img src="<?= base_url('uploads/') ?>' + productList[i].image + '" width="100"></td>';
                        html += '<td>';
                        html += '<button type="button" class="btn btn-primary btn-sm edit-btn" data-bs-toggle="modal" data-bs-target="#addProductModal" data-product-id="' + productList[i].id + '">Edit</button>';
                        html += ' <button type="button" class="btn btn-danger btn-sm delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-product-id="' + productList[i].id + '">Delete</button>';
                        html += '</td>';
                        html += '</tr>';
                    }

                    $('#productTable tbody').html(html);
                }
            });
        }

        function getStarRatingHtml(rating) {
            var starsHtml = '';
            var fullStars = Math.floor(rating);
            var halfStar = rating - fullStars >= 0.5;
            for (var i = 0; i < fullStars; i++) {
                starsHtml += '<i class="ri-star-fill"></i>';
            }
            if (halfStar) {
                starsHtml += '<i class="ri-star-half-fill"></i>';
            }
            var emptyStars = 5 - Math.ceil(rating);
            for (var j = 0; j < emptyStars; j++) {
                starsHtml += '<i class="ri-star-line"></i>';
            }
            return '<div class="star-rating">' + starsHtml + '</div>';
        }

        updateProductTable();

        $('#addProductModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var productId = button.data('product-id');
            var modal = $(this);
            var form = modal.find('#productForm');
            form.trigger('reset'); // Reset the form

            if (productId) {
                // Editing an existing product
                modal.find('.modal-title').text('Edit Product');
                modal.find('#productId').val(productId);

                $.ajax({
                    url: "<?= base_url('product/getProduct'); ?>/" + productId,
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        var product = response.product;
                        modal.find('#product_name').val(product.product_name);
                        modal.find('#category_id').val(product.category_id);
                        modal.find('#prize').val(product.prize);
                    }
                });
            } else {
                // Adding a new product
                modal.find('.modal-title').text('Add Product');
            }
        });

        $('#productForm').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var formData = new FormData(form[0]);
            $.ajax({
                url: "<?= base_url('product/saveProduct'); ?>",
                type: "POST",
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message
                        }).then(function() {
                            $('#addProductModal').modal('hide');
                            updateProductTable();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });

        var deleteProductId;

        $(document).on('click', '.delete-btn', function() {
            deleteProductId = $(this).data('product-id');
        });

        $('#deleteConfirmBtn').click(function() {
            if (deleteProductId) {
                $.ajax({
                    url: "<?= base_url('product/deleteProduct'); ?>/" + deleteProductId,
                    type: "DELETE",
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message
                            }).then(function() {
                                $('#deleteModal').modal('hide');
                                updateProductTable();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            } else {
                console.error("deleteProductId is undefined.");
            }
        });

        $(document).on('click', '.star-rating i', function() {
            var rating = $(this).index() + 1;
            var productId = $(this).closest('tr').find('td:first-child').text();
            $.ajax({
                url: "product/saveRating/" + productId,
                type: "POST",
                data: {
                    rating: rating
                },
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message
                        }).then(function() {
                            updateProductTable();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });


    });
</script>



<?= $this->endSection() ?>