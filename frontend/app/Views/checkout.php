<?= $this->extend('main') ?>
<?= $this->section('content') ?>
<section class="pb-lg-13 pb-11">
    <div class="container">
        <h2 class="text-center my-9">Check Out</h2>

        <?php // echo "<pre>"; print_r($cartItems);die; 
        ?>
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
                                    <span class="d-block ml-auto text-secondary fs-24 font-weight-bold">$99.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 pr-xl-15 order-lg-first form-control-01">
                        <p class="mb-2">Returning customer? <a href="#" data-toggle="modal" data-target="#sign-in">Click
                                here to login</a></p>
                        <p>Have a coupon? <a data-toggle="collapse" href="#collapsecoupon" role="button" aria-expanded="false" aria-controls="collapsecoupon">Click here to enter your
                                code</a></p>
                        <!-- Rest of the checkout form code here -->
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkoutBtn = document.querySelector('.checkout-btn');
        checkoutBtn.addEventListener('click', function() {
            // Implement the logic to redirect to the checkout page here
            window.location.href = "checkout.html";
        });
    });
</script>
<?= $this->endSection() ?>