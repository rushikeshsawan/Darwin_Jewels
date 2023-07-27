<?= $this->extend('main') ?>
<?= $this->section('content') ?>
<style>
    .highlighted {
        background-color: #f5f5f5;
    }
</style>

<section class="pb-lg-13 pb-11">
    <div class="container">
        <h2 class="text-center my-9">Check Out</h2>

        <?php if (!empty($cartItems)) : ?>
            <form>
                <div class="row">
                    <div class="col-lg-4 pb-lg-0 pb-11 order-lg-last">
                        <div class="card border-0" style="box-shadow: 0 0 10px 0 rgba(0,0,0,0.1)">
                            <div class="card-header px-0 mx-6 bg-transparent py-5">
                                <h4 class="fs-24 mb-5">Order Summary</h4>
                                <?php foreach ($cartItems as $product) : ?>
                                    <div class="media w-100 mb-4">
                                        <div class="w-60px mr-3">
                                            <?php if (array_key_exists('image', $product)) : ?>
                                                <img src="<?= $product['image'] ?>" alt=" a">
                                            <?php endif; ?>
                                        </div>
                                        <div class="media-body d-flex">
                                            <div class="cart-price pr-6">
                                                <a href="#" class="text-secondary pr-6"><?= $product['name'] ?><span class="text-body"> x<?= $product['quantity'] ?></span></a>
                                                <p class="fs-14 text-secondary mb-0 mt-1">Size:<span class="text-body"> Fullsize</span></p>
                                            </div>
                                            <div class="ml-auto">
                                                <p class="fs-14 text-secondary mb-0 font-weight-bold">₹<?= $product['price'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="card-body px-6 pt-5">
                                <div class="d-flex align-items-center mb-2">
                                    <span>Subtotal:</span>
                                    <span class="d-block ml-auto text-secondary font-weight-bold">$99.00</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span>Shipping:</span>
                                    <span class="d-block ml-auto text-secondary font-weight-bold">$0</span>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent px-0 pb-1 mx-6">
                                <div class="d-flex align-items-center font-weight-bold mb-3">
                                    <span class="text-secondary">Total price:</span>
                                    <span class="d-block ml-auto text-secondary fs-24 font-weight-bold"><?= $product['TotalPrice'] ?></span>
                                </div>
                            </div>
                            <div class="card text-center">
                                <button type="button" class="btn btn-primary checkout-btn">Proceed to Checkout</button>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-8 pr-xl-15 order-lg-first form-control-01">
                        <p class="mb-2">Returning customer? <a href="#" data-toggle="modal" data-target="#sign-in">Click
                                here to login</a></p>
                        <p>Have a coupon? <a data-toggle="collapse" href="#collapsecoupon" role="button" aria-expanded="false" aria-controls="collapsecoupon">Click here to enter your
                                code</a></p>
                        <h4 class="fs-24 pt-1 mb-4">Shipping Information</h4>
                        <div id="addressData">
                            <?php if (!empty($address)) : ?>
                                <div class="row">
                                    <?php foreach ($address as $addr) : ?>
                                        <div class="col-md-6 mb-6 address-card" data-address-id="<?= $addr['id']; ?>">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title"><?= $addr['name']; ?></h5>
                                                    <p class="card-text"><strong>Address:</strong> <?= $addr['address']; ?></p>
                                                    <p class="card-text"><strong>Mobile:</strong> <?= $addr['mobile']; ?></p>
                                                    <p class="card-text"><strong>Email:</strong> <?= $addr['email']; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else : ?>
                                <div class="alert alert-info">
                                    <p>No addresses found.</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </form>
        <?php else : ?>
            <div class="alert alert-info mt-4" role="alert">
                Your cart is empty. Please add items to your cart before proceeding to checkout.
            </div>
        <?php endif; ?>
</section>
<div class="modal" id="sign-in" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="loginForm">
                    <input type="hidden" name="user_id" id="user_id" value="<?= $id ?>">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address">
                    </div>
                    <div class="form-group">
                        <label for="mobile">Mobile Number</label>
                        <input type="text" class="form-control" id="mobile" name="mobile">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="zip">Zip</label>
                        <input type="text" class="form-control" id="zip" name="zip">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">

<script>
    $(document).ready(function() {
        $("#loginForm").submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('address'); ?>",
                data: formData,
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        $('#sign-in').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message
                        }).then(function() {
                            // Add the new address card to the #addressData section
                            var newAddressCard = '<div class="col-md-6 mb-6">' +
                                '<div class="card">' +
                                '<div class="card-body">' +
                                '<h5 class="card-title">' + response.address.name + '</h5>' +
                                '<p class="card-text"><strong>Address:</strong> ' + response.address.address + '</p>' +
                                '<p class="card-text"><strong>Mobile:</strong> ' + response.address.mobile + '</p>' +
                                '<p class="card-text"><strong>Email:</strong> ' + response.address.email + '</p>' +
                                '</div>' +
                                '</div>' +
                                '</div>';

                            $('#addressData .alert-info').remove(); // Remove the "No addresses found" message if present
                            $('#addressData .row').append(newAddressCard); // Append the new address card to the #addressData section
                        });
                    } else {
                        // Show SweetAlert error message
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'There were errors in the form:\n' + JSON.stringify(response.errors, null, 2)
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'An error occurred during form submission.'
                    });
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        function selectAddress(addressId) {
            $('.address-card').removeClass('highlighted'); // Remove highlight from other addresses
            $('.address-card[data-address-id="' + addressId + '"]').addClass('highlighted'); // Add highlight to the selected address
            $.ajax({
                type: 'POST',
                url: '<?= base_url('storeaddress'); ?>', // Update the URL to match the correct route in AddressController
                data: {
                    address_id: addressId
                },
                dataType: 'json',
                success: function(response) {},
                error: function() {}
            });
        }
        $('.address-card').click(function() {
            var addressId = $(this).data('address-id');
            selectAddress(addressId); // Pass the address ID to the selectAddress function
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkoutBtn = document.querySelector('.checkout-btn');
        checkoutBtn.addEventListener('click', function() {
            placeOrder();
        });
    });

    function placeOrder() {
    const selectedAddressId = document.querySelector('.address-card.highlighted').dataset.addressId;

    // Collect product IDs and total price
    let product_id = [];
    let totalPrice = 0;

    const cartItems = <?= json_encode($cartItems) ?>;
    console.log(cartItems)
    if (cartItems && cartItems.length > 0) {
        cartItems.forEach(product => {
            product_id.push(product.productid); // Assuming 'product_id' is the correct key for product IDs
            totalPrice += parseFloat(product.price) * parseInt(product.quantity);
        });
    }
    console.log('Product IDs:', product_id);
    console.log('Total Price:', totalPrice);

    const formData = {
        address_id: selectedAddressId,
        product_id: product_id,
        total_price: totalPrice
    };

    // Make sure you are using the correct URL to process the order in your PHP controller
    $.ajax({
        type: "POST",
        url: "placeOrder", // Update this URL to the correct endpoint in your PHP controller
        data: formData,
        dataType: "json",
        success: function(response) {
            alert(response.message);
        },
        error: function(response) {
            alert(response.error)
            alert("An error occurred while placing the order.");
        }
    });
} 
</script>

<?= $this->endSection() ?>