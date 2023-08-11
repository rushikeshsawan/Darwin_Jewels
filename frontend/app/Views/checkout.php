<?= $this->extend('main') ?>
<?= $this->section('content') ?>
<style>
    .highlighted {
        background-color: #6676a2;
        color: white;
    }

    .payment-option {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .payment-option img {
        width: 40px;
        height: 40px;
        margin-right: 10px;
    }

    .payment-option label {
        cursor: pointer;
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
                                                <p class="fs-14 text-secondary mb-0 font-weight-bold"><?= $product['Qprice'] ?></p>
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
                                    <span class="text-secondary">Total price.:</span>
                                    <span class="d-block ml-auto text-secondary fs-24 font-weight-bold FTotalPrice"><?= $product['TotalPrice'] ?></span>
                                </div>
                            </div>
                            <div class="card text-center">
                                <!-- <button type="button" class="btn btn-primary checkout-btn">Proceed to Checkout</button> -->
                                <button type="button" class="btn btn-primary checkout-btn" id="checkoutButton">Proceed to Checkout</button>
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
                                        <div class="col-md-6 mb-6">
                                            <div class="card  address-body  address-card" data-address-id="<?= $addr['id']; ?>">
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
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Select Payment Option</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="payment-option">
                            <label id="cashOnDeliveryLabel" for="codOption">
                                <img src="<?= base_url('/uploads/payment/cod.jpg') ?>" alt="Cash on Delivery">
                                Cash on Delivery
                            </label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="payment-option">
                            <label id="onlineOption" for="onlineOption">
                                <img src="<?= base_url('/uploads/payment/online_icon.jpg') ?>" alt="Online Payment">
                                Online Payment
                            </label>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="walletOption" checked>
                        <label class="form-check-label" for="walletOption">
                            Wallet (Balance: <span id="walletBalance">300</span>)
                        </label>
                    </div>
                </div> -->

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="confirmPaymentButton">Confirm Payment</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="walletModal" tabindex="-1" aria-labelledby="walletModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="walletModalLabel">Wallet Balance</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="mb-4 walletBalance"> </p>

            </div>
            <p class="mb-4"> Would you like to use this for the order?</p>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="no">NO</button>
                <button type="button" class="btn btn-primary" id="yes">YES</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="OnlineWalletModal" tabindex="-1" aria-labelledby="OnlineWalletModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="walletModalLabel">Wallet Balance</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="mb-4 walletBalance"> </p>

            </div>
            <p class="mb-4"> Would you like to use this for the order?</p>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="ONo">NO</button>
                <button type="button" class="btn btn-primary" id="OYes">YES</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
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
                            $('#addressData .alert-info').remove();
                            $('#addressData .row').append(newAddressCard);
                        });
                    } else {
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
            $('.address-card').removeClass('highlighted');
            $('.address-card[data-address-id="' + addressId + '"]').addClass('highlighted');
            $.ajax({
                type: 'POST',
                url: '<?= base_url('storeaddress'); ?>',
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
            selectAddress(addressId);
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#checkoutButton').click(function() {
            const selectedAddressId = $('.address-card.highlighted').data('address-id');
            if (selectedAddressId) {
                $('#paymentModal').modal('show');
                $('#cashOnDeliveryLabel').on('click', function() {
                    $.ajax({
                        url: 'get_payment_options',
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            var walletBalance = parseFloat(response.walletBalance);
                            if (walletBalance > 0) {
                                var test = $('#walletModal .modal-body .walletBalance').html('Your wallet balance: ₹ ' + walletBalance.toFixed(2));
                                $('#paymentModal').modal('hide');
                                $('#walletModal').modal('show');
                            } else {
                                alert('1')
                                placeOrder("COD");
                            }
                        },
                        error: function() {
                            alert('Error fetching wallet balance.');
                        }
                    });
                });
                $('#no').click(function() {
                    $('#walletModal').modal('hide');
                    alert('2')
                    placeOrder("COD");
                });
                $('#yes').click(function() {
                    console.log('hii')
                    var totalPrize = parseFloat($('.FTotalPrice').text().replace(/₹|,/g, "").trim());
                    console.log(totalPrize)
                    var walletBalance = parseFloat($('.walletBalance').text().replace('Your wallet balance: ₹', '').trim());
                    console.log(walletBalance)
                    if (walletBalance >= totalPrize) {
                        walletBalance -= totalPrize;
                        var useWallet = totalPrize
                        $('#walletBalance').text(walletBalance.toFixed(2));
                        $('#walletModal').modal('hide');
                        placeOrder("Wallet", useWallet, walletBalance);
                    } else {
                        var useWallet = walletBalance
                        placeOrder("COD/Wallet", useWallet, walletBalance);
                    }
                });
            } else {
                Swal.fire({
                    icon: 'info',
                    title: 'Select Address',
                    text: 'Please select an address before proceeding to checkout.',
                });
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#onlineOption').on('click', function() {
            $.ajax({
                url: 'get_payment_options',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var walletBalance = parseFloat(response.walletBalance);
                    if (walletBalance > 0) {
                        var test = $('#OnlineWalletModal .modal-body .walletBalance').html('Your wallet balance: ₹ ' + walletBalance.toFixed(2));
                        $('#paymentModal').modal('hide');
                        $('#OnlineWalletModal').modal('show');
                    } else {
                        const totalPrice = parseFloat($('.FTotalPrice').text().replace(/₹|[, ]/g, ''));
                        const selectedAddressId = $('.address-card.highlighted').data('address-id');
                        const cartItems = <?= json_encode($cartItems) ?>;
                        handlePayment(totalPrice, selectedAddressId, cartItems);
                    }
                },
                error: function() {
                    alert('Error fetching wallet balance.');
                }
            });
        });
        $('#ONo').click(function() {
            const totalPrice = parseFloat($('.FTotalPrice').text().replace(/₹|[, ]/g, ''));
            const selectedAddressId = $('.address-card.highlighted').data('address-id');
            const cartItems = <?= json_encode($cartItems) ?>;
            handlePayment(totalPrice, selectedAddressId, cartItems);
        });
        $('#OYes').click(function() {
            console.log('hii')
            var totalPrize = parseFloat($('.FTotalPrice').text().replace(/₹|,/g, "").trim());
            console.log(totalPrize)
            var walletBalance = parseFloat($('.walletBalance').text().replace('Your wallet balance: ₹', '').trim());
            console.log(walletBalance)
            if (walletBalance >= totalPrize) {
                walletBalance -= totalPrize;
                var useWallet = totalPrize
                alert(useWallet)
                alert("'#OYes useWallet")
                $('#walletBalance').text(walletBalance.toFixed(2));
                $('#walletModal').modal('hide');
                placeOrder("Wallet", useWallet, walletBalance);
            } else {
                alert("#Oyes")
                alert(walletBalance)
                var totalPriceOnline = totalPrize - walletBalance
                var totalPrice = totalPriceOnline;
                const selectedAddressId = $('.address-card.highlighted').data('address-id');
                const cartItems = <?= json_encode($cartItems) ?>;
                handlePayment(totalPrice, selectedAddressId, cartItems, walletBalance);
            }
        });

        function handlePayment(TotalPrice, selectedAddressId, cartItems, walletBalance) {
            alert('handlePayment')
            alert(walletBalance)
            var amountInPaise = TotalPrice * 100;
            var options = {
                key: 'rzp_test_GGXHzqc5bmnUdI',
                amount: amountInPaise,
                currency: 'INR',
                name: 'Retail',
                description: 'Payment for your order',
                handler: function(response) {
                    var payment_id = response.razorpay_payment_id;
                    console.log(response);
                    if (walletBalance > 0) {
                        alert("iff handlepayment")
                        var walletBalance;
                        var payment_id = payment_id + "/Wallet";
                        placeOrder(payment_id, walletBalance);
                    } else {
                        placeOrder(payment_id, walletBalance);
                    }

                },
            };
            var rzp = new Razorpay(options);
            rzp.open();
        }
        // $('#OYes').click(function() {
        //     console.log('hii')
        //     var totalPrize = parseFloat($('.FTotalPrice').text().replace(/₹|,/g, "").trim());
        //     console.log(totalPrize)
        //     var walletBalance = parseFloat($('.walletBalance').text().replace('Your wallet balance: ₹', '').trim());
        //     console.log(walletBalance)
        //     if (walletBalance >= totalPrize) {
        //         walletBalance -= totalPrize;
        //         var useWallet = totalPrize
        //         alert(useWallet)
        //         alert("useWallet")
        //         $('#walletBalance').text(walletBalance.toFixed(2));
        //         $('#walletModal').modal('hide');
        //         placeOrder("Wallet", useWallet, walletBalance);
        //     } else {
        //         var useWallet = walletBalance
        //         placeOrder("Online/Wallet", useWallet, walletBalance);
        //     }
        // });
    });
</script>
<script>
    $(document).ready(function() {
        function selectAddress(addressId) {
            $('.address-body').removeClass('highlighted');
            $('.address-body[data-address-id="' + addressId + '"]').addClass('highlighted');
            $.ajax({
                type: 'POST',
                url: '<?= base_url('storeaddress'); ?>',
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
            selectAddress(addressId);
        });
    });
</script>
<script>
    function placeOrder(payment_id = '', useWallet = '', walletBalance = '' ) {
        alert('placeOrder')
        alert(walletBalance)
        var selectedAddressId = document.querySelector('.address-card.highlighted').dataset.addressId;
        let product_id = [];
        let quantity = [];
        let Qprice = [];
        let totalPrice = 0;

        var cartItems = <?= json_encode($cartItems) ?>;
        console.log('cartItems')
        console.log(cartItems)
        if (cartItems && cartItems.length > 0) {
            cartItems.forEach(product => {
                product_id.push(product.productid);
                quantity.push(product.quantity);
                Qprice.push(product.Qprice);
                totalPrice += parseFloat(product.price) * parseInt(product.quantity);
            });
        }
        console.log('Product IDs:', product_id);
        console.log('Total Price:', totalPrice);
        console.log('quantity:', quantity);
        console.log('Qprice:', Qprice);
        var formData = {
            address_id: selectedAddressId,
            product_id: product_id,
            quantity: quantity,
            Qprice: Qprice,
            total_price: totalPrice,
            payment_id: payment_id,
            useWallet: useWallet
        };
        $.ajax({
            type: "POST",
            url: "placeOrder",
            data: formData,
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Order Successful!',
                        text: 'Your order has been placed successfully.',
                    }).then(function() {
                        $.ajax({
                            type: 'POST',
                            url: 'clearCartItems',
                            dataType: 'json',
                            success: function(response) {
                                alert(payment_id)
                                alert('placeOrder')
                                alert(walletBalance)
                                if (payment_id.includes('Wallet') || payment_id == 'Wallet') {
                                    updateWallet(useWallet, walletBalance, payment_id)
                                }
                                // window.location.href = '/order_list';
                            },
                            error: function() {
                                alert("An error occurred while clearing cart items.");
                            }
                        });
                    });
                } else {
                    alert("Failed to place order. Please try again.");
                }
            },
            error: function(response) {
                alert("An error occurred while placing the order.");
            }
        });

    }

    function updateWallet(useWallet, walletBalance, payment_id) {
        alert('payment_id.includes')
        alert(walletBalance)
        alert(useWallet)
        var wallet = walletBalance - useWallet;
        alert(wallet)
        var csrfToken = '<?= csrf_hash() ?>';
        $.ajax({
            type: 'POST',
            url: 'update_wallet',
            data: {
                wallet: wallet,
                csrf_token: csrfToken
            },
            success: function(response) {
                alert('Wallet updated successfully.');
            },
            error: function(xhr, status, error) {
                alert('Error updating wallet.');
            }
        });
    }
</script>
<?= $this->endSection() ?>