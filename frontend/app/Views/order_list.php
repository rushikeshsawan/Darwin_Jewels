<!-- orders.php -->
<?= $this->extend('main') ?>
<?= $this->section('content') ?>

<div class="container">
    <h2>My Orders</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order) : ?>
                <tr>
                    <td><?= $order['order_id'] ?></td>
                    <td><?= $order['total_price'] ?></td>
                    <td><?= $order['status'] ?></td>
                    <td><?= $order['created_at'] ?></td>
                    <td>
                        <button class="btn btn-primary view-details-btn" data-order-id="<?= $order['order_id'] ?>">View Details</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="modal fade" id="orderDetailsModal" tabindex="-1" role="dialog" aria-labelledby="orderDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderDetailsModalLabel">Order Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="order-details-container">
                    <div class="modal-body">
                        <div class="card border-0" style="box-shadow: 0 0 10px 0 rgba(0,0,0,0.1)"> 
                        </div>
                    </div>
                </div>
                <div class="card border-0" style="box-shadow: 0 0 10px 0 rgba(0,0,0,0.1)">
                    <div class="card-body px-6 pt-5">
                        <h4 class="bold">Total price: <span id="totalPriceSection">₹ 0</span></h4>
                    </div>
                </div>
                <div class="card border-0" style="box-shadow: 0 0 10px 0 rgba(0,0,0,0.1)">
                    <div class="card-body px-6 pt-5">
                        <h6 class="bold">Address: <span id="address"></span></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- <script>
    $(document).ready(function() {
        $(".view-details-btn").click(function() {
            var orderId = $(this).data("order-id");
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('getOrderDetails'); ?>",
                data: {
                    order_id: orderId
                },
                dataType: "json",
                success: function(response) {
                    if (response) {
                        console.log(response)
                        $(".order-details-container").empty();
                        $.each(response, function(index, product) {
                            var productDetails = `
                                <div class="card border-0 mb-3" style="box-shadow: 0 0 10px 0 rgba(0,0,0,0.1);">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-md-3">
                                            <img class="w-100" src="<?= base_url('/uploads/FeatureProduct/') ?>` + product.image + `" alt="Product Image">
                                        </div>
                                        <div class="col-md-9">
                                            <div class="card-body px-3 pt-2">
                                                <h5 class="card-title mb-2">` + product.product_name + `</h5>
                                                <p class="card-text mb-2 text-muted">Price: ₹` + product.prize + ` x ` + product.quantity + `</p>
                                                <p class="card-text font-weight-bold mb-0">Total Price: ₹` + product.Qprice + `</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                            $(".order-details-container").append(productDetails);
                        });
                        $('#orderDetailsModal').modal('show');
                    } else {
                        alert("Order details not found.");
                    }
                },
                error: function() {
                    alert("Error occurred while fetching order details.");
                }
            });
        });
    });
</script> -->
<script>
    $(document).ready(function() {
        $(".view-details-btn").click(function() {
            var orderId = $(this).data("order-id");
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('getOrderDetails'); ?>",
                data: {
                    order_id: orderId
                },
                dataType: "json",
                success: function(response) {
                    if (response) {
                        console.log(response);
                        $(".order-details-container").empty();
                        var totalPrice = 0;
                        $.each(response, function(index, product) {
                            var productDetails = `
                                <div class="card border-0 mb-3" style="box-shadow: 0 0 10px 0 rgba(0,0,0,0.1);">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-md-3">
                                            <img class="w-100" src="<?= base_url('/uploads/FeatureProduct/') ?>` + product.image + `" alt="Product Image">
                                        </div>
                                        <div class="col-md-9">
                                            <div class="card-body px-3 pt-2">
                                                <h5 class="card-title mb-2">` + product.product_name + `</h5>
                                                <p class="card-text mb-2 text-muted">Price: ₹` + product.prize + ` x ` + product.quantity + `</p>
                                                <p class="card-text font-weight-bold mb-0">Total Price: ₹` + product.Qprice + `</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                            totalPrice = parseFloat(product.total_price);
                            address = (product.address);
                            $(".order-details-container").append(productDetails);
                        });
                        $("#totalPriceSection").text("₹ " + totalPrice.toFixed(2));
                        $("#address").text(address);
                        $('#orderDetailsModal').modal('show');
                    } else {
                        alert("Order details not found.");
                    }
                },
                error: function() {
                    alert("Error occurred while fetching order details.");
                }
            });
        });
    });
</script>
<?= $this->endSection() ?>