<!-- Extend the 'main' layout -->
<?= $this->extend('main') ?>

<!-- Start the 'content' section -->
<?= $this->section('content') ?>
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
                                <?php if (!empty($cartItems)) : ?>
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
                                <?php endif; ?>
                            </div>
                            <div class="card-body px-6 pt-5">
                                <div class="d-flex align-items-center mb-2">
                                    <span>Subtotal:</span>
                                    <span class="d-block ml-auto text-secondary font-weight-bold TotalPrice">₹<?= $product['TotalPrice'] ?></span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span>Shipping:</span>
                                    <span class="d-block ml-auto text-secondary font-weight-bold">$0</span>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent px-0 pb-1 mx-6">
                                <div class="d-flex align-items-center font-weight-bold mb-3">
                                    <span class="text-secondary">Total price:</span>
                                    <span class="d-block ml-auto text-secondary fs-24 font-weight-bold">₹<?= $product['TotalPrice'] ?></span>
                                </div>
                            </div>
                        </div>                    </div>
                    <div class="col-lg-8 pr-xl-15 order-lg-first form-control-01">
                    <p class="mb-2">Returning customer? <a href="#" data-toggle="modal" data-target="#sign-in">Click
                                here to login</a></p>
                        <p>Have a coupon? <a data-toggle="collapse" href="#collapsecoupon" role="button" aria-expanded="false" aria-controls="collapsecoupon">Click here to enter your
                                code</a></p>                        <h4 class="fs-24 pt-1 mb-4">Shipping Information</h4>
                        <div id="addressData">
                            <?php if (!empty($address)) : ?>
                                <div class="row">
                                    <?php foreach ($address as $addr) : ?>
                                        <?php
                                         $selectedAddressId = $this->session->get('selected_address_id');
                                        ?>
                                        <div class="col-md-6 mb-6">
                                             <div class="card <?= ($selectedAddressId == $addr['id']) ? 'selected-address' : ''; ?>" data-address-id="<?= $addr['id']; ?>">
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
    </div>
</section>

<!-- Include jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // When a user clicks on an address card, store the selected address ID in the session
    $(document).ready(function () {
        $('.card').on('click', function () {
            const addressId = $(this).data('address-id');
            $.ajax({
                type: 'POST',
                url: '<?= base_url('store_selected_address'); ?>',
                data: { addressId: addressId },
                dataType: 'json',
                success: function (response) {
                    // Update the card's highlighting based on the selected address ID
                    $('.card').removeClass('selected-address');
                    $('.card[data-address-id="' + addressId + '"]').addClass('selected-address');
                },
                error: function () {
                    console.error('An error occurred while storing the selected address.');
                }
            });
        });
    });
</script>

<!-- End the 'content' section -->
<?= $this->endSection() ?>
