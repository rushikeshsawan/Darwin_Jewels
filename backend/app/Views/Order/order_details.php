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
                <th>Bill</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($order as $orderItem) : ?>
                <tr>
                    <td><?= $orderItem['order_id'] ?></td>
                    <td><?= $orderItem['total_price'] ?></td>
                    <td id="<?= $orderItem['order_id'] ?>-status"><?= $orderItem['status'] ?></td>
                    <td><?= $orderItem['created_at'] ?></td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Change Status</button>
                            <div class="dropdown-menu">
                                <button class="dropdown-item update-status" data-order-id="<?= $orderItem['order_id'] ?>" data-status="progress">Progress</button>
                                <button class="dropdown-item update-status" data-order-id="<?= $orderItem['order_id'] ?>" data-status="shipped">Shipped</button>
                                <button class="dropdown-item update-status" data-order-id="<?= $orderItem['order_id'] ?>" data-status="delivered">Delivered</button>
                                <button class="dropdown-item update-status" data-order-id="<?= $orderItem['order_id'] ?>" data-status="cancel">Cancel</button>
                                <button class="dropdown-item update-status" data-order-id="<?= $orderItem['order_id'] ?>" data-status="refunded">Refunded</button>
                            </div>
                        </div>
                    </td>
                    <td>
                        <button class="btn btn-primary view-details-btn" data-order-id="<?= $orderItem['order_id'] ?>">View Details</button>

                        <a target="_blank" href="<?php echo base_url('invoice/' . $orderItem['order_id']); ?>"> <button class="btn btn-danger " data-toggle="modal" data-target="#invoiceModal">Generate Invoice</button></a>
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
<!-- Add this modal code within your HTML body -->
<div class="modal fade" id="invoiceModal" tabindex="-1" role="dialog" aria-labelledby="invoiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="invoiceModalLabel">Invoice Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Customer Information:</h6>
                        <p><strong>Name:</strong> <span id="modalCustomerName"></span></p>
                        <p><strong>Address:</strong> <span id="modalCustomerAddress"></span></p>
                        <!-- Add more customer information fields as needed -->
                    </div>
                    <div class="col-md-6">
                        <h6>Invoice Details:</h6>
                        <p><strong>Order ID:</strong> <span id="modalOrderId"></span></p>
                        <p><strong>Total Price:</strong> $<span id="modalTotalPrice"></span></p>
                        <!-- Add more invoice details as needed -->
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- Add more footer buttons if required -->
            </div>
        </div>
    </div>
</div>


<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('.update-status').on('click', function() {
            var orderId = $(this).data('order-id');
            var newStatus = $(this).data('status');

            $.ajax({
                url: 'update_order_status', // Replace with your controller route
                type: 'POST',
                data: {
                    orderId: orderId,
                    newStatus: newStatus
                },
                success: function(response) { 
                    console.log('Status updated successfully'); 
                    $(`#${orderId}-status`).text(newStatus);
                    if (newStatus === 'delivered') {
                        $(`#${orderId}-status`).text(newStatus); 
                        $.ajax({
                            url: 'increase_wallet', 
                            type: 'POST',
                            data: {
                                orderId: orderId
                            },
                            success: function(walletResponse) {
                                console.error(walletResponse); 
                                console.log('Wallet increased successfully'); 
                            },
                            error: function(walletXhr, walletStatus, walletError) {
                                console.error(orderId);
                                console.error(walletError);
                            }
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
<script>
    $(document).ready(function() {
        $('.generate-invoice').on('click', function() {
            var orderId = $(this).data('order-id');
            $.ajax({
                url: '/controller_name/fetch_invoice_data',
                type: 'POST',
                data: {
                    order_id: orderId
                },
                success: function(response) {
                    openInvoiceModal(response);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });

        function openInvoiceModal(data) {
            $('#customerNameModal').text(data.customer_name);
            $('#customerAddressModal').text(data.customer_address);
            // Update other modal elements similarly

            $('#invoiceModal').modal('show');
        }
    });
</script>
<script>
    $(document).ready(function() {
        $(".view-details-btn").click(function() {
            var orderId = $(this).data('order-id');
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