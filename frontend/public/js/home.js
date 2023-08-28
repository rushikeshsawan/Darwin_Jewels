$(document).ready(function() {
        $('.QuickView').on('click', function(e) {
            alert('js')
            e.preventDefault();
            var productId = $(this).data('product-id'); 
            alert(productId)
            $.ajax({
                url: 'quickview', // The URL mapped in the Routes.php file
                method: 'POST',
                data: {
                    product_id: productId
                }, // Send the product ID to the server
                dataType: 'json',
                success: function(response) {
                    console.log(response)
                    $('#quick-view .test').text(response.id);
                    $('#quick-view .ProductPrize').text(response.prize); 
                    $('#quick-view .product-title').text(response.product_name);
                    $('#quick-view .product-image').attr('src', '/uploads/FeatureProduct/' + response.image);
                    $('#quick-view .view-slider-for img').each(function(index) {
                        $(this).attr('src', '/uploads/FeatureProduct/' + response.image);
                    });
                    $('#quick-view').modal('show');
                },
                error: function() {
                    alert('An error occurred while fetching the product details.');
                }
            });
        });
    });
    var productId;
    $('.add-to-bag').on('click', function(e) {
        var testElement = document.getElementsByClassName('test')[0];  
        var ProductPrizeElement=document.getElementsByClassName('ProductPrize')[0];   
        var productId = testElement ? testElement.textContent : 'No test element found';
        var ProductPrize = ProductPrizeElement ? ProductPrizeElement.textContent : 'No test element found';
        console.log(productId) 
        console.log(ProductPrize)  
        var quantity = parseInt($('#quickview-number').val()); // Get the quantity value
        var totalprize=ProductPrize*quantity
        alert(totalprize)
        $.ajax({
            url: 'add-to-cart',  
            method: 'POST',
            data: {
                product_id: productId,
                quantity: quantity,
                totalprize: totalprize
            },
            dataType: 'json',
            success: function(response) {
                // Handle the success response
            },
            error: function() {
                // Handle the error response
            }
        });
    });
    

    $('.add-to-wishlist').on('click', function(e) {
        e.preventDefault();
        var productId = $(this).data('product-id');
        alert(productId)
        $.ajax({
            url: 'add-to-cart', // Route to add a product to the cart
            method: 'POST',
            data: {
                product_id: productId
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    var message = 'Product added to cart.';
                    var redirectUrl = 'cart-list';
                    if (response.alreadyAdded) {
                        message = 'Product is already in the cart.';
                        // redirectUrl = 'cart-list';
                    }
                    Swal.fire({
                        icon: response.alreadyAdded ? 'info' : 'success',
                        title: 'Cart',
                        text: message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        // Redirect to the cart list page after adding the product
                        // window.location.href = redirectUrl;
                    });
                } else {
                    // Show an error SweetAlert if the response is not successful
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message
                    });
                }
            },
            error: function() {
                // Show an error SweetAlert if an error occurs during the AJAX request
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while adding the product to the cart.'
                });
            }
        });
    });
    function loadData() {
        $.ajax({
            url: 'products', 
            method: 'GET',
            dataType: 'html', 
            success: function(response) {
                $('#ajax').html(response);
            },
            error: function() {
                console.error('An error occurred while loading data.');
            }
        });
    }

    $(document).ready(function() {
        loadData(); 
    });