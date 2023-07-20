<?= $this->extend('main') ?>
<?= $this->section('content') ?>
<section class="pb-11 pb-lg-13">
    <div class="container">
        <h2 class="text-center mt-9 mb-8">Shopping Cart</h2>
        <form class="table-responsive-md pb-8 pb-lg-10">
            <table class="table border">
                <thead style="background-color: #F5F5F5">
                    <tr class="fs-15 letter-spacing-01 font-weight-600 text-uppercase text-secondary">
                        <th scope="col" class="border-1x pl-7">products</th>
                        <th scope="col" class="border-1x">quantity</th>
                        <th colspan="2" class="border-1x">Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cartItems as $product) : ?>
                        <tr class="position-relative">
                            <th scope="row" class="w-xl-695 pl-xl-5 py-4">
                                <div class="media align-items-center">
                                    <input class="checkbox-primary w-15px h-15px" type="checkbox" name="check-product" value="checkbox">
                                    <div class="ml-3 mr-4">
                                        <img src="<?= base_url('/uploads/FeatureProduct/' . $product['image']) ?>" alt="Natural Coconut Cleansing Oil" class="mw-75px">
                                    </div>
                                    <div class="media-body w-128px">
                                        <p class="font-weight-500 mb-1 text-secondary"><?= $product['product_name']; ?></p>
                                        <p class="card-text font-weight-bold fs-14 mb-1 text-secondary">
                                            <span class="fs-13 font-weight-500 text-decoration-through text-body pr-1">$39.00</span>
                                            <span><?= $product['prize']; ?></span>
                                        </p>
                                    </div>
                                </div>
                            </th>
                            <td class="align-middle">
                                <div class="input-group position-relative w-128px">
                                    <a href="#" class="down position-absolute pos-fixed-left-center pl-2 z-index-2"><i class="far fa-minus"></i></a>
                                    <input name="number[]" type="number" class="form-control form-control-sm px-6 fs-16 text-center input-quality border-0 h-35px" value="1" required>
                                    <a href="#" class="up position-absolute pos-fixed-right-center pr-2 z-index-2"><i class="far fa-plus"></i></a>
                                </div>
                            </td>
                            <td class="align-middle">
                                <p class="mb-0 text-secondary font-weight-bold mr-xl-11"><?= $product['prize']; ?></p>
                            </td>
                            <td class="align-middle text-right pr-5"><a href="#" class="d-block"><i class="fal fa-times text-body"></i></a></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td class="pb-6 pl-0 position-relative bg-white" style="left: -1px">
                            <button type="submit" value="Continue Shopping" class="btn btn-outline-secondary border-2x border mr-5 border-hover-secondary my-3">Continue Shopping</button>
                            <button type="submit" value="Clear Shopping Cart" class="btn btn-link p-0 border-0 border-bottom border-secondary rounded-0 my-3"><i class="fal fa-times mr-2 text-secondary"></i>Clear Shopping Cart</button>
                        </td>
                        <td colspan="3" class="text-right pb-6 pr-0 position-relative bg-white" style="right: -2px">
                            <button type="submit" value="Update Cart" class="btn btn-outline-secondary border-2x border border-hover-secondary my-3">Update Cart</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
        <div class="row">
            <div class="col-lg-4 pt-2">
                <!-- Your existing coupon code form -->
            </div>
            <div class="col-lg-4 pt-lg-2 pt-10">
                <!-- Your existing shipping form -->
            </div>
            <?php
            // Initialize the total price variable before the loop
            $totalPrice = 0;
            ?>
            <?php foreach ($cartItems as $product) : ?>
                <?php
                $productPrice = str_replace(',', '', $product['prize']);
                $totalPrice += floatval($productPrice);
                ?>
            <?php endforeach; ?>
            <div class="col-lg-4 pt-lg-0 pt-11">
                <div class="card border-0" style="box-shadow: 0 0 10px 0 rgba(0,0,0,0.1)">
                    <div class="card-body px-6 pt-5">
                        <div class="d-flex align-items-center mb-2">
                            <span>Subtotal:</span>
                            <span class="d-block ml-auto text-secondary font-weight-bold">$<?= number_format($totalPrice, 2); ?></span>
                        </div>
                        <div class="d-flex align-items-center">
                            <span>Shipping:</span>
                            <span class="d-block ml-auto text-secondary font-weight-bold">$0</span>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent px-0 pb-4 mx-6">
                        <div class="d-flex align-items-center font-weight-bold mb-3">
                            <span class="text-secondary">Total price:</span>
                            <span class="d-block ml-auto text-secondary fs-24 font-weight-bold">$<?= number_format($totalPrice, 2); ?></span>
                        </div>
                        <button type="submit" class="btn btn-secondary btn-block bg-hover-primary border-hover-primary" value="Check Out">Check Out</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>