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
                        $quantity = isset($product['quantity']) ? $product['quantity'] : 1;
                        $productPrice = str_replace(',', '', $product['prize']);
                        $totalProductPrice += floatval($productPrice);
                        ?> 
                        <tr class="position-relative">
                            <th class="d-none"> 
                            <span class="d-block ml-auto text-secondary fs-24 font-weight-bold total-price TotalPrice">₹<?= number_format($totalProductPrice, 2); ?></span>  
                            </th>
                            <th scope="row" class="w-xl-695 pl-xl-5 py-4 " >
                                <div class="media align-items-center">
                                    <input class="checkbox-primary w-15px h-15px" type="checkbox" name="check-product" value="checkbox">
                                     <div class="ml-3 mr-4  product-image img">
                                        <img src="<?= $product['image']; ?>" alt="<?= $product['image'] ?>" class="mw-75px">
                                    </div>
                                    <div class="media-body w-128px">
                                        <p class="font-weight-500 mb-1 text-secondary product-name"><?= $product['name']; ?></p>
                                        <p class="card-text font-weight-bold fs-14 mb-1 text-secondary">
                                            <span class="fs-13 font-weight-500 text-decoration-through text-body pr-1"></span>
                                            <span class="product-price price"><?= $product['prize']; ?></span>
                                        </p>
                                    </div>
                                    <div  class="d-none">
                                    <p class="productid"><?= $product['id']; ?></p>
                                    </div>
                                </div>
                            </th>
                            <td class="align-middle">
                                <div class="input-group position-relative w-128px">
                                    <a href="#" class="down position-absolute pos-fixed-left-center pl-2 z-index-2"><i class="far fa-minus"></i></a>
                                    <input name="number[]" type="number" class="form-control form-control-sm px-6 fs-16 text-center input-quality border-0 h-35px" value="<?= $quantity; ?>" min="1" required data-initial-quantity="<?= $quantity; ?>">
                                    <a href="#" class="up position-absolute pos-fixed-right-center pr-2 z-index-2"><i class="far fa-plus"></i></a>
                                </div>
                            </td>
                            <td class="align-middle">
                                <p class="mb-0 text-secondary font-weight-bold mr-xl-11 subtotal-price   Qprice">₹<?= $product['prize']; ?></p>
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
                            <span class="d-block ml-auto text-secondary fs-24 font-weight-bold total-price TotalPrice">₹<?= number_format($totalProductPrice, 2); ?></span>
                        </div>
                        <button type="button" class="btn btn-secondary btn-block bg-hover-primary border-hover-primary checkout-btn" onclick="moveToCheckout()">Check Out</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.all.min.js"></script> 
<script>
    function moveToCheckout() {
        var cartItems = [];
        $('tbody tr').each(function() {
            var productName = $(this).find('.product-name').text();
            var Qprice = $(this).find('.Qprice').text();
            var price = $(this).find('.price').text();
            var quantity = parseInt($(this).find('.input-quality').val());
            var image = $(this).find('.product-image img').attr('src');  
            var TotalPrice = $(this).find('.TotalPrice').text(); 
            var productid = $(this).find('.productid').text(); 
            
            cartItems.push({
                image: image,
                name: productName,
                quantity: quantity,
                Qprice: Qprice,
                price: price, 
                TotalPrice:TotalPrice,
                productid:productid
            });
        });

        if (cartItems.length === 0) {
            alert("Your cart is empty. Please add items to your cart before proceeding to checkout.");
            return;
        }

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
                window.location.href = "/checkout";
            },
            error: function(xhr, status, error) {
                console.error(error);
                alert("Failed to add cart items to the session. Please try again.");
            }
        });
    }

     $('.checkout-btn').on('click', function() {
        moveToCheckout();
    }); 
  
</script>


<script>
    $(document).ready(function() {
        function updateProductSubtotal($row) {
            var quantity = parseInt($row.find('.input-quality').val());
            var price = parseFloat($row.find('.product-price').text().replace('$', '').replace(',', ''));
            var subTotal = quantity * price;
            $row.find('.subtotal-price').text('₹' + subTotal.toFixed(0));
            return subTotal;
        }

        function updateTotalPrice() {
            var totalPrice = 0;
            $('tbody tr').each(function() {
                var subTotal = updateProductSubtotal($(this));
                totalPrice += subTotal;
            });
            $('.total-price').text('₹' + totalPrice.toFixed(0));
        }

        $('tbody').on('click', '.up', function(e) {
            e.preventDefault();
            var $row = $(this).closest('tr');
            var $quantityInput = $row.find('.input-quality');
            var quantity = parseInt($quantityInput.val());
            $quantityInput.val(quantity); // Increase quantity by 1
            updateProductSubtotal($row);
            updateTotalPrice();
        });

        $('tbody').on('click', '.down', function(e) {
            e.preventDefault();
            var $row = $(this).closest('tr');
            var $quantityInput = $row.find('.input-quality');
            var quantity = parseInt($quantityInput.val());
            if (quantity > 0) {
                $quantityInput.val(quantity);
                updateProductSubtotal($row);
                updateTotalPrice();
            } else {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Do you want to remove this product from the cart?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var key = $row.find('.remove-item-btn').data('key');
                        removeFromSession(key);
                    }
                });
            }
        });
        $('.remove-item-btn').on('click', function(e) {
            e.preventDefault();
            var key = $(this).data('key');
            removeFromSession(key);
        });

        function removeFromSession(key) {
            $.ajax({
                type: "POST",
                url: "/cart/removeFromCart", // Use the defined route to handle the AJAX request
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    key: key
                },
                success: function(response) {
                    alert(response.message);
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert("Failed to remove the item from the cart. Please try again.");
                }
            });
        } 
    }); 
</script>
<?= $this->endSection() ?>