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
                    <?php $totalProductPrice = 0; ?>
                    <?php foreach ($cartItems as $key => $product) : ?>
                        <?php
                        // Set a default quantity value if 'quantity' key is not available
                        $quantity = isset($product['quantity']) ? $product['quantity'] : 1;
                        $productPrice = str_replace(',', '', $product['prize']);
                        $totalProductPrice += floatval($productPrice);
                        ?>
                        <tr class="position-relative">
                            <th scope="row" class="w-xl-695 pl-xl-5 py-4">
                                <div class="media align-items-center">
                                    <input class="checkbox-primary w-15px h-15px" type="checkbox" name="check-product" value="checkbox">
                                    <div class="ml-3 mr-4  product-image img">
                                        <img src="<?= $product['image']; ?>" alt="<?= $product['image'] ?>" class="mw-75px">
                                    </div>
                                    <div class="media-body w-128px">
                                        <p class="font-weight-500 mb-1 text-secondary product-name"><?= $product['name']; ?></p>
                                        <p class="card-text font-weight-bold fs-14 mb-1 text-secondary">
                                            <span class="fs-13 font-weight-500 text-decoration-through text-body pr-1"></span>
                                            <span class="product-price  "><?= $product['prize']; ?></span>
                                        </p>
                                    </div>
                                </div>
                            </th>
                            <td class="align-middle">
                                <div class="input-group position-relative w-128px">
                                    <a href="#" class="down position-absolute pos-fixed-left-center pl-2 z-index-2"><i class="far fa-minus"></i></a>
                                    <!-- Dynamically set the initial quantity value from the server -->
                                    <input name="number[]" type="number" class="form-control form-control-sm px-6 fs-16 text-center input-quality border-0 h-35px" value="<?= $quantity; ?>" min="1" required>
                                    <a href="#" class="up position-absolute pos-fixed-right-center pr-2 z-index-2"><i class="far fa-plus"></i></a>
                                </div>
                            </td>
                            <td class="align-middle">
                                <p class="mb-0 text-secondary font-weight-bold mr-xl-11 subtotal-price price"><?= $product['prize']; ?></p>
                            </td>
                            <td class="align-middle text-right pr-5">
                                <a href="#" class="d-block remove-item-btn" data-key="<?= $key ?>"><i class="fal fa-times text-body"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </form>
        <div class="row">
            <div class="col-lg-4 pt-2">
                <!-- ... Your code for coupon discount form ... -->
            </div>
            <div class="col-lg-4 pt-lg-2 pt-10">
                <!-- ... Your code for shipping options form ... -->
            </div>
            <div class="col-lg-4 pt-lg-0 pt-11">
                <div class="card border-0" style="box-shadow: 0 0 10px 0 rgba(0,0,0,0.1)">
                    <div class="card-body px-6 pt-5">
                        <div class="d-flex align-items-center mb-2">
                            <span>Subtotal:</span>
                            <!-- Display the total product price -->
                            <span class="d-block ml-auto text-secondary font-weight-bold">$<?= number_format($totalProductPrice, 2); ?></span>
                        </div>
                        <div class="d-flex align-items-center">
                            <span>Shipping:</span>
                            <span class="d-block ml-auto text-secondary font-weight-bold">$0</span>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent px-0 pb-4 mx-6">
                        <div class="d-flex align-items-center font-weight-bold mb-3">
                            <span class="text-secondary">Total price:</span>
                            <!-- Display the total product price -->
                            <span class="d-block ml-auto text-secondary fs-24 font-weight-bold total-price">$<?= number_format($totalProductPrice, 2); ?></span>
                        </div>
                        <button type="button" class="btn btn-secondary btn-block bg-hover-primary border-hover-primary checkout-btn" onclick="moveToCheckout()">Check Out</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- <script>
    // Function to fetch cart data via AJAX
    function fetchCartData() {
        $.ajax({
            url: '/checkout/fetchCartData', // URL to your AJAX function in HomeController
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                // For now, let's just log the response to the console
                console.log(response);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    // Function to add cart items to the session and redirect to checkout page
    function addToSessionAndRedirectToCheckout(cartItems) {
        $.ajax({
            url: '/checkout/addToSession', // URL to your AJAX function in HomeController
            type: 'POST',
            data: {
                cartItems: cartItems
            },
            dataType: 'json',
            success: function(response) {
                // Handle the response, for example, display a success message
                alert(response.message);
                // Redirect to the checkout page
                window.location.href = '/checkout';
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    $(document).ready(function() {
        // Example usage of addToCart function
        $('#addToCartBtn').on('click', function() {
            var productId = 123; // Replace with the actual product ID
            addToCart(productId);
        });

        // Example usage of addToSessionAndRedirectToCheckout function
        $('.checkout-btn').on('click', function() {
            var cartItems = [
                // Replace with the actual array of cart items
                {
                    id: 1,
                    name: 'Product 1',
                    price: 10.99
                },
                {
                    id: 2,
                    name: 'Product 2',
                    price: 15.99
                },
                // ...
            ];
            addToSessionAndRedirectToCheckout(cartItems);
        });
    });
</script> -->
<script>
    function moveToCheckout() {
        var cartItems = [];
        $('tbody tr').each(function() {
            var productName = $(this).find('.product-name').text();
            var price = $(this).find('.price').text();
            var quantity = parseInt($(this).find('.input-quality').val());
            var image = $(this).find('.product-image img').attr('src'); // Assuming the product image is inside an element with class 'product-image'
            cartItems.push({
                image: image,
                name: productName,
                quantity: quantity,
                price: price
            });
        });

        // Check if the cart is not empty
        if (cartItems.length === 0) {
            alert("Your cart is empty. Please add items to your cart before proceeding to checkout.");
            return;
        }

        // Make the AJAX request to add cart items to the session
        $.ajax({
            type: "POST",
            url: "/checkout/addToSession",
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                cartItems: cartItems
            },
            success: function(response) {
                // Redirect to the checkout page after successfully adding cart items to the session
                window.location.href = "/checkout";
            },
            error: function(xhr, status, error) {
                console.error(error);
                alert("Failed to add cart items to the session. Please try again.");
            }
        });
    }

    // Bind the `moveToCheckout()` function to the checkout button click event
    $('.checkout-btn').on('click', function() {
        moveToCheckout();
    });

    function removeFromSession(key) {
        $.ajax({
            type: "POST",
            url: "checkout/removeFromSession",
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                key: key
            },
            success: function(response) {
                alert(response) 
                window.location.reload();
            },
            error: function(xhr, status, error) {
                console.error(error);
                alert("Failed to remove the item from the cart. Please try again.");
            }
        });
    }

    // Bind the click event for the "Remove" buttons
    $('.remove-item-btn').on('click', function(e) {
        e.preventDefault();
        var key = $(this).data('key');
        removeFromSession(key);
    });
</script>
<script>
    $(document).ready(function() {

        $('.up').on('click', function(e) {
            e.preventDefault();
            var totalPrice = 0;
            $('tbody tr').each(function() {
                var quantity = parseInt($(this).find('.input-quality').val());
                quantity += 1; // Increase quantity by 1 using the shorthand operator
                var price = parseFloat($(this).find('.product-price').text().replace('$', '').replace(',', ''));
                // alert(quantity)
                // alert(price)
                var subTotal = quantity * price;
                // alert(subTotal)
                $(this).find('.subtotal-price').text('$' + subTotal.toFixed(0));
                totalPrice += subTotal;
            });
            $('.total-price').text('$' + totalPrice.toFixed(0));
        });

        $('.down').on('click', function(e) {
            e.preventDefault();
            var totalPrice = 0;
            $('tbody tr').each(function() {
                var input = $(this).parent().find('.input-quality');
                var quantity = parseInt(input.val());
                var price = parseFloat($(this).find('.product-price').text().replace('$', '').replace(',', ''));
                quantity -= 1;
                var subTotal = quantity * price;
                alert(subTotal)
                $(this).find('.subtotal-price').text('$' + subTotal.toFixed(0));
                totalPrice += subTotal;
            });
            $('.total-price').text('$' + totalPrice.toFixed(0));
        });

        // function updatePrices() {
        //     var totalPrice = 0;
        //     $('tbody tr').each(function() {
        //         var input = $(this).parent().find('.input-quality'); 
        //         let quantity = parseInt(input.val());
        //         var price = parseFloat($(this).find('.product-price').text().replace('$', '').replace(',', ''));
        //         alert(quantity)
        //         // alert(price)
        //         var subTotal = quantity * price;
        //         alert(subTotal)
        //         $(this).find('.subtotal-price').text('$' + subTotal.toFixed(0));
        //         totalPrice += subTotal;
        //     });
        //     $('.total-price').text('$' + totalPrice.toFixed(0));
        // }  
    });
</script>

<?= $this->endSection() ?>