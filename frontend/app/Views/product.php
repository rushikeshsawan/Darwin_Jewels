<?= $this->extend('main') ?>
<?= $this->section('content') ?>
<main id="content">
    <section class="py-2 bg-gray-2">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-site py-0 d-flex justify-content-center">
                    <li class="breadcrumb-item"><a class="text-decoration-none text-body" href="home">Home</a>
                    </li>
                    <li class="breadcrumb-item active pl-0 d-flex align-items-center" aria-current="page">Shop Grid
                        layout
                    </li>
                </ol>
            </nav>
        </div>
    </section>
    <section>
        <div class="container container-xl">
            <h2 class="text-center mt-9 mb-8">Product</h2>
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <p class="fs-18 font-weight-500 my-lg-0 my-2" style="color: #696969;">We found <strong class="font-weight-bold text-secondary">95</strong>
                    products available for you</p>
                <div class="d-flex align-items-center">

                    <div class="dropdown show lh-1 rounded ml-lg-5 ml-0" style="background-color:#f5f5f5">
                        <a href="#" class="dropdown-toggle custom-dropdown-toggle text-decoration-none text-secondary p-3 mw-210 position-relative d-block" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Default Sorting.
                        </a>
                        <div class="dropdown-menu custom-dropdown-item" aria-labelledby="dropdownMenuButton">
                            <!-- Add the 'onclick' event to your price filter links -->
                            <!-- Add the 'onclick' event to your price filter links -->
                            <a class="dropdown-item" href="javascript:void(0)" onclick="applyPriceFilter('high_to_low')">Price high to low</a>
                            <a class="dropdown-item" href="javascript:void(0)" onclick="applyPriceFilter('low_to_high')">Price low to high</a>

                            <a class="dropdown-item">Price low to high</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="mt-7 pb-11 pb-lg-13">
        <div class="container container-xl">
            <div class="row">
                <div class="col-lg-3 primary-sidebar sidebar-sticky pr-lg-8 d-lg-block d-none" id="sidebar">
                    <div class="primary-sidebar-inner">
                        <div class="card border-0 mb-6">
                            <div class="card-header bg-transparent border-0 p-0">
                                <h4 class="card-title fs-20 mb-3">Categories</h4>
                            </div>
                            <div class="card-body p-0">
                                <ul class="list-unstyled mb-0">
                                    <!-- <li class="mb-2">
                                        <a href="#" class="text-uppercase fs-14 letter-spacing-005 font-weight-600 text-body hover-secondary text-decoration-none">BODY
                                            CARE</a>
                                    </li> -->
                                    <li class="mb-2">
                                        <a href="#" class="text-uppercase fs-14 letter-spacing-005 font-weight-600 text-body hover-secondary text-decoration-none">Jewellery</a>
                                        <ul class="list-unstyled ml-5 mt-2 mb-5">
                                            <?php foreach ($Category as $row) : ?>
                                                <li class="mb-2">
                                                    <a href="#" class="text-uppercase fs-14 letter-spacing-005 font-weight-600 text-body hover-secondary text-decoration-none category-link" onclick="getProducts(<?= $row['id']; ?>)"><?= $row['categoryname']; ?></a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card border-0 mb-6">
                            <div class="card-header bg-transparent border-0 p-0">
                                <h4 class="card-title fs-20 mb-3">Hightlight</h4>
                            </div>
                            <div class="card-body p-0">
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2">
                                        <a href="#" class="text-body hover-secondary">
                                            Best Seller
                                        </a>
                                    </li>
                                    <li class="mb-2">
                                        <a href="#" class="text-body hover-secondary">
                                            New Arrivals
                                        </a>
                                    </li>
                                    <li class="mb-2">
                                        <a href="#" class="text-body hover-secondary">
                                            Sale
                                        </a>
                                    </li>
                                    <li class="mb-2">
                                        <a href="#" class="text-body hover-secondary">
                                            Hot Items
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card border-0 mb-6">
                            <div class="card-header bg-transparent border-0 p-0">
                                <h4 class="card-title fs-20 mb-3">Price</h4>
                            </div>
                            <div class="card-body p-0">
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2">
                                        <a href="#" class="text-body hover-secondary">
                                            <span>All</span>
                                        </a>
                                    </li>
                                    <li class="mb-2">
                                        <a href="#" class="text-body hover-secondary">
                                            <span>$50</span>
                                            <span> - </span>
                                            <span>$99</span>
                                        </a>
                                    </li>
                                    <li class="mb-2">
                                        <a href="#" class="text-body hover-secondary">
                                            <span>$100</span>
                                            <span> - </span>
                                            <span>$499</span>
                                        </a>
                                    </li>
                                    <li class="mb-2">
                                        <a href="#" class="text-body hover-secondary">
                                            <span>$500</span>
                                            <span> - </span>
                                            <span>$2000</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card border-0" style="max-width:240px">
                            <div class="card-header bg-transparent border-0 p-0">
                                <h3 class="card-title fs-20 mb-3">
                                    Tags
                                </h3>
                            </div>
                            <div class="card-body p-0">
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item mr-2 pb-1">
                                        <a href="#" class="text-body hover-secondary">Cleansing</a>
                                    </li>
                                    <li class="list-inline-item mr-2 pb-1">
                                        <a href="#" class="text-body hover-secondary">Make up</a>
                                    </li>
                                    <li class="list-inline-item mr-2 pb-1">
                                        <a href="#" class="text-body hover-secondary">eye cream</a>
                                    </li>
                                    <li class="list-inline-item mr-2 pb-1">
                                        <a href="#" class="text-body hover-secondary">nail</a>
                                    </li>
                                    <li class="list-inline-item mr-2 pb-1">
                                        <a href="#" class="text-body hover-secondary">oil</a>
                                    </li>
                                    <li class="list-inline-item mr-2 pb-1">
                                        <a href="#" class="text-body hover-secondary">shampoo</a>
                                    </li>
                                    <li class="list-inline-item mr-2 pb-1">
                                        <a href="#" class="text-body hover-secondary">coffee bean</a>
                                    </li>
                                    <li class="list-inline-item mr-2 pb-1">
                                        <a href="#" class="text-body hover-secondary">healthy</a>
                                    </li>
                                    <li class="list-inline-item mr-2 pb-1">
                                        <a href="#" class="text-body hover-secondary">skin care</a>
                                    </li>
                                    <li class="list-inline-item mr-2 pb-1">
                                        <a href="#" class="text-body hover-secondary">sale</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div id="productContainer" class="row">
                        <div class="row" id="Fproduct">
                            <?php foreach ($Product as $row) : ?>
                                <div class="col-lg-3 col-sm-6 mb-5" data-animate="fadeInUp">
                                    <div class="card border-0 product">
                                        <div class="position-relative">
                                            <img src="<?= base_url('/uploads/FeatureProduct/' . $row['image']) ?>" alt="Facial cleanser">
                                            <div class="card-img-overlay d-flex p-3">
                                                <div class="my-auto w-100 content-change-vertical">
                                                    <a href="product-detail.html" data-toggle="tooltip" data-placement="left" title="View products" class="add-to-cart ml-auto d-flex align-items-center justify-content-center text-secondary bg-white hover-white bg-hover-secondary w-48px h-48px rounded-circle mb-2">
                                                        <svg class="icon icon-shopping-bag-open-light fs-24">
                                                            <use xlink:href="#icon-shopping-bag-open-light"></use>
                                                        </svg>
                                                    </a>
                                                    <a href="#" data-toggle="tooltip" data-placement="left" title="Quick view" class="preview QuickView ml-auto d-md-flex align-items-center justify-content-center cursor-pointer text-secondary bg-white hover-white bg-hover-secondary w-48px h-48px rounded-circle mb-2 d-none" data-product-id="<?= $row['id']; ?>">
                                                        <span data-toggle="modal" data-target="#quick-view">
                                                            <svg class="icon icon-eye-light fs-24">
                                                                <use xlink:href="#icon-eye-light"></use>
                                                            </svg>
                                                        </span>
                                                    </a>
                                                    <a href="" data-toggle="tooltip" data-placement="left" title="Add to wishlist" class="add-to-wishlist ml-auto d-flex align-items-center justify-content-center text-secondary bg-white hover-white bg-hover-secondary w-48px h-48px rounded-circle mb-2" data-product-id="<?= $row['id']; ?>">
                                                        <svg class="icon icon-star-light fs-24">
                                                            <use xlink:href="#icon-star-light"></use>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body px-0 pt-4 text-center">
                                            <p class="card-text font-weight-bold fs-16 mb-1 text-secondary">
                                                <span class="fs-13 font-weight-500 text-decoration-through text-body pr-1">$39.00</span>
                                                <span><?= $row['prize']; ?></span>
                                            </p>
                                            <h2 class="card-title fs-15 font-weight-500 mb-2"><a href="product-detail.html">
                                                    <?= $row['product_name']; ?>
                                                </a>
                                            </h2>
                                            <div class="d-flex align-items-center justify-content-center flex-wrap">
                                                <ul class="list-inline mb-0 lh-1">
                                                    <li class="list-inline-item fs-12 text-primary mr-0"><i class="fas fa-star"></i></li>
                                                    <li class="list-inline-item fs-12 text-primary mr-0"><i class="fas fa-star"></i></li>
                                                    <li class="list-inline-item fs-12 text-primary mr-0"><i class="fas fa-star"></i></li>
                                                    <li class="list-inline-item fs-12 text-primary mr-0"><i class="fas fa-star"></i></li>
                                                    <li class="list-inline-item fs-12 text-primary mr-0"><i class="fas fa-star"></i></li>
                                                </ul>
                                                <span class="card-text fs-14 font-weight-400 pl-2 lh-1">2947 reviews</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <nav class="pt-3">
                        <ul class="pagination justify-content-center align-items-center mb-0 fs-16 font-weight-600">
                            <li class="page-item fs-18 d-none d-sm-block">
                                <a class="page-link rounded-circle w-40px h-40 p-0 justify-content-center align-items-center d-flex" href="#" tabindex="-1"><i class="far fa-angle-double-left"></i></a>
                            </li>
                            <li class="page-item">
                                <a class="page-link rounded-circle w-40px h-40 p-0 justify-content-center align-items-center d-flex" href="#">1</a>
                            </li>
                            <li class="page-item active" aria-current="page">
                                <a class="page-link rounded-circle w-40px h-40 p-0 justify-content-center align-items-center d-flex" href="#">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link rounded-circle w-40px h-40 p-0 justify-content-center align-items-center d-flex" href="#">3</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link rounded-circle w-40px h-40 p-0 justify-content-center align-items-center d-flex" href="#">4</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link rounded-circle w-40px h-40 p-0 justify-content-center align-items-center d-flex" href="#">5</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link rounded-circle w-40px h-40 p-0 justify-content-center align-items-center d-flex" href="#">...</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link rounded-circle w-40px h-40 p-0 justify-content-center align-items-center d-flex" href="#">16</a>
                            </li>
                            <li class="page-item fs-18 d-none d-sm-block">
                                <a class="page-link rounded-circle w-40px h-40 p-0 justify-content-center align-items-center d-flex" href="#"><i class="far fa-angle-double-right"></i></a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <nav class="pt-3">
                    <ul class="pagination justify-content-center align-items-center mb-0 fs-16 font-weight-600">
                        <li class="page-item fs-18 d-none d-sm-block">
                            <a class="page-link rounded-circle w-40px h-40 p-0 justify-content-center align-items-center d-flex" href="#" tabindex="-1"><i class="far fa-angle-double-left"></i></a>
                        </li>
                        <li class="page-item">
                            <a class="page-link rounded-circle w-40px h-40 p-0 justify-content-center align-items-center d-flex" href="#">1</a>
                        </li>
                        <li class="page-item active" aria-current="page">
                            <a class="page-link rounded-circle w-40px h-40 p-0 justify-content-center align-items-center d-flex" href="#">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link rounded-circle w-40px h-40 p-0 justify-content-center align-items-center d-flex" href="#">3</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link rounded-circle w-40px h-40 p-0 justify-content-center align-items-center d-flex" href="#">4</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link rounded-circle w-40px h-40 p-0 justify-content-center align-items-center d-flex" href="#">5</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link rounded-circle w-40px h-40 p-0 justify-content-center align-items-center d-flex" href="#">...</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link rounded-circle w-40px h-40 p-0 justify-content-center align-items-center d-flex" href="#">16</a>
                        </li>
                        <li class="page-item fs-18 d-none d-sm-block">
                            <a class="page-link rounded-circle w-40px h-40 p-0 justify-content-center align-items-center d-flex" href="#"><i class="far fa-angle-double-right"></i></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        </div>
    </section>
</main>
<div class="position-fixed pos-fixed-bottom-right p-6 z-index-10">
    <a href="#" class="gtf-back-to-top text-decoration-none bg-white text-primary hover-white bg-hover-primary shadow p-0 w-48px h-48px rounded-circle fs-20 d-flex align-items-center justify-content-center" title="Back To Top"><i class="fal fa-arrow-up"></i></a>
</div>
<div class="canvas-sidebar cart-canvas">
    <div class="canvas-overlay">
    </div>
    <div class="card border-0 pt-4 pb-7 h-100">
        <div class="px-6 text-right">
            <span class="canvas-close d-inline-block fs-24 mb-1 ml-auto lh-1 text-primary"><i class="fal fa-times"></i></span>
        </div>
        <div class="card-header bg-transparent p-0 mx-6">
            <h3 class="fs-24 mb-5">
                Shopping bag
            </h3>
            <p class="fs-15 font-weight-500 text-body mb-5"><span class="d-inline-block mr-2 fs-15 text-secondary"><i class="far fa-check-circle"></i></span>
                Your cart is saved for the next <span class="text-secondary">4m34s</span></p>
        </div>
        <div class="card-body px-6 pt-7 overflow-y-auto">
            <div class="mb-4 d-flex">
                <a href="#" class="d-flex align-items-center mr-2 text-muted"><i class="fal fa-times"></i></a>
                <div class="media w-100">
                    <div class="w-60px mr-3">
                        <img src="images/cart-01.jpg" alt="atural Coconut Cleansing Oil">
                    </div>
                    <div class="media-body d-flex">
                        <div class="cart-price pr-6">
                            <p class="fs-14 font-weight-bold text-secondary mb-1"><span class="font-weight-500 fs-13 text-line-throug69text-body mr-1">₹ 3,58,755</span>₹ 3,58,755
                            </p>
                            <a href="#" class="text-secondary">Natural Coconut Cleansing Oil</a>
                        </div>
                        <div class="position-relative ml-auto">
                            <div class="input-group">
                                <a href="#" class="down position-absolute pos-fixed-left-center pl-2"><i class="far fa-minus"></i></a>
                                <input type="number" class="number-cart w-90px px-6 text-center h-40px bg-input border-0" value="1">
                                <a href="#" class="up position-absolute pos-fixed-right-center pr-2"><i class="far fa-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-4 d-flex">
                <a href="#" class="d-flex align-items-center mr-2 text-muted"><i class="fal fa-times"></i></a>
                <div class="media w-100">
                    <div class="w-60px mr-3">
                        <img src="images/cart-02.jpg" alt="Super Pure">
                    </div>
                    <div class="media-body d-flex">
                        <div class="cart-price pr-6">
                            <p class="fs-14 font-weight-bold text-secondary mb-1"><span class="font-weight-500 fs-13 text-line-throug69text-body mr-1">₹ 3,58,755</span>₹ 3,58,755
                            </p>
                            <a href="#" class="text-secondary">Super Pure</a>
                        </div>
                        <div class="position-relative ml-auto">
                            <div class="input-group">
                                <a href="#" class="down position-absolute pos-fixed-left-center pl-2"><i class="far fa-minus"></i></a>
                                <input type="number" class="number-cart w-90px px-6 text-center h-40px bg-input border-0" value="1">
                                <a href="#" class="up position-absolute pos-fixed-right-center pr-2"><i class="far fa-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-4 d-flex">
                <a href="#" class="d-flex align-items-center mr-2 text-muted"><i class="fal fa-times"></i></a>
                <div class="media w-100">
                    <div class="w-60px mr-3">
                        <img src="images/cart-03.jpg" alt="Cleansing Balm">
                    </div>
                    <div class="media-body d-flex">
                        <div class="cart-price pr-6">
                            <p class="fs-14 font-weight-bold text-secondary mb-1"><span class="font-weight-500 fs-13 text-line-throug69text-body mr-1">₹ 3,58,755</span>₹ 3,58,755
                            </p>
                            <a href="#" class="text-secondary">Cleansing Balm</a>
                        </div>
                        <div class="position-relative ml-auto">
                            <div class="input-group">
                                <a href="#" class="down position-absolute pos-fixed-left-center pl-2"><i class="far fa-minus"></i></a>
                                <input type="number" class="number-cart w-90px px-6 text-center h-40px bg-input border-0" value="1">
                                <a href="#" class="up position-absolute pos-fixed-right-center pr-2"><i class="far fa-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer mt-auto border-0 bg-transparent px-6 pb-0 pt-5">
            <div class="d-flex align-items-center mb-2">
                <span class="text-secondary fs-15">Total price:</span>
                <span class="d-block ml-auto fs-24 font-weight-bold text-secondary">$106.00</span>
            </div>
            <a href="checkout.html" class="btn btn-secondary btn-block mb-3 bg-hover-primary border-hover-primary">Check Out</a>
            <a href="shopping-cart.html" class="btn btn-outline-secondary btn-block">View Cart</a>
        </div>
    </div>
</div>
<div class="mfp-hide search-popup mfp-with-anim" id="search-popup">
    <form>
        <div class="input-group position-relative">
            <div class="input-group-prepend d-none d-md-block">
                <select class="selectpicker" name="category" id="region-01" data-style="btn-lg letter-spacing-0 border-0 border-bottom border-2x bg-transparent text-white border-white fs-24 pl-0 shadow-none text-capitalize font-weight-normal rounded-0">
                    <option value="" selected>All Categories</option>
                    <option value="chairs">Chairs</option>
                    <option value="stands">Stands</option>
                    <option value="tables">Tables</option>
                    <option value="accessory">Accessory</option>
                </select>
            </div>
            <input type="text" id="keyword" name="keyword" class="form-control border-0 border-bottom border-2x bg-transparent text-white border-white fs-24 form-control-lg" placeholder="Search Something...">
            <div class="input-group-append position-absolute pos-fixed-right-center">
                <button class="input-group-text bg-transparent border-0 text-white fs-30 px-0 btn-lg" type="submit"><i class="far fa-search"></i></button>
            </div>
        </div>
    </form>
</div>
<div class="sidenav canvas-sidebar bg-white">
    <div class="canvas-overlay">
    </div>
    <div class="pt-5 pb-7 card border-0 h-100">
        <div class="d-flex align-items-center card-header border-0 py-0 pl-8 pr-7 mb-9 bg-transparent">
            <a href="index.html" class="d-block w-179px">
                <img src="images/logo/DP-Retail.png" alt="Glowing">
            </a>
            <span class="canvas-close d-inline-block text-right fs-24 ml-auto lh-1 text-primary"><i class="fal fa-times"></i></span>
        </div>
        <div class="overflow-y-auto pb-6 pl-8 pr-7 card-body pt-0">
            <ul class="navbar-nav main-menu px-0 ">
                <li aria-haspopup="true" aria-expanded="false" class="nav-item dropdown py-1 px-0">
                    <a class="nav-link p-0" href="index.html">
                        Home
                        <span class="caret"></span>
                    </a>

                </li>
                <li aria-haspopup="true" aria-expanded="false" class="nav-item dropdown py-1 px-0">
                    <a class="nav-link  p-0" href="product.html">
                        Product
                        <span class="caret"></span>
                    </a>

                </li>
                <li aria-haspopup="true" aria-expanded="false" class="nav-item dropdown py-1 px-0">
                    <a class="nav-link  p-0" href="benifit.html">
                        Benifits
                        <span class="caret"></span>
                    </a>

                </li>
                <li aria-haspopup="true" aria-expanded="false" class="nav-item dropdown py-1 px-0">
                    <a class="nav-link  p-0" href="contact-us.html">
                        Contact
                        <span class="caret"></span>
                    </a>

                </li>
                <li aria-haspopup="true" aria-expanded="false" class="nav-item dropdown py-1 px-0">
                    <a class="nav-link  p-0" href="" data-toggle="dropdown">
                        Dashboard
                        <span class="caret"></span>
                    </a>

                </li>
                <li aria-haspopup="true" aria-expanded="false" class="nav-item dropdown py-1 px-0">
                    <a class="nav-link  p-0" href="" data-toggle="dropdown">
                        Docs
                        <span class="caret"></span>
                    </a>

                </li>
            </ul>
        </div>
        <div class="card-footer bg-transparent border-0 mt-auto pl-8 pr-7 pb-0 pt-4">
            <ul class="list-inline d-flex align-items-center mb-3">
                <li class="list-inline-item mr-4"><a href="" class="fs-20 lh-1"><i class="fab fa-pinterest-p"></i></a>
                </li>
                <li class="list-inline-item mr-4"><a href="" class="fs-20 lh-1"><i class="fab fa-facebook-f"></i></a></li>
                <li class="list-inline-item mr-4"><a href="" class="fs-20 lh-1"><i class="fab fa-instagram"></i></a>
                </li>
                <li class="list-inline-item"><a href="" class="fs-20 lh-1"><i class="fab fa-twitter"></i></a></li>
            </ul>
            <p class="mb-0 text-gray">
                Copyright © 2023 Dp Jewels. All Rights Reserved
            </p>
        </div>
    </div>
</div>
<div class="modal sign-in" id="sign-in" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-0 p-6">
                <nav class="w-100">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-link active" id="nav-log-in-tab" data-toggle="tab" href="#nav-log-in" role="tab" aria-controls="nav-log-in" aria-selected="true">Log in</a>
                        <a class="nav-link" id="nav-register-tab" data-toggle="tab" href="#nav-register" role="tab" aria-controls="nav-register" aria-selected="false">Register</a>
                    </div>
                </nav>
                <button type="button" class="close opacity-10 fs-32 pt-1 position-absolute" data-dismiss="modal" aria-label="Close" style="right: 30px">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-9 pb-8">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-log-in" role="tabpanel" aria-labelledby="nav-log-in-tab">
                        <h4 class="fs-34 text-center mb-6">Sign In</h4>
                        <p class="text-center fs-16 mb-7">Don’t have an account yet? <a href="#" class="text-secondary border-bottom text-decoration-none">Sign up</a> for free</p>
                        <form>
                            <input name="email" type="email" class="form-control border-0 mb-3" placeholder="Your email" required>
                            <input name="password" type="password" class="form-control border-0" placeholder="Password" required>
                            <div class="d-flex align-items-center justify-content-between mt-5 mb-4">
                                <div class="custom-control custom-checkbox">
                                    <input name="stay-signed-in" type="checkbox" class="custom-control-input" id="staySignedIn">
                                    <label class="custom-control-label text-body" for="staySignedIn">Stay signed
                                        in</label>
                                </div>
                                <a href="#" class="text-secondary">Forgot your password?</a>
                            </div>
                            <button type="submit" value="Login" class="btn btn-secondary btn-block bg-hover-primary border-hover-primary">Log
                                In</button>
                            <div class="border-bottom mt-6"></div>
                            <div class="text-center mt-n2 lh-1 mb-4">
                                <span class="fs-14 bg-white lh-1 mt-n2 px-4">or Log-in with</span>
                            </div>
                            <div class="d-flex">
                                <a href="#" class="btn btn-outline-secondary btn-block border-2x border mr-5 border-hover-secondary"><i class="fab fa-facebook-f mr-2" style="color: #2E58B2"></i>Facebook</a>
                                <a href="#" class="btn btn-outline-secondary btn-block border-2x border mt-0 border-hover-secondary"><i class="fab fa-google mr-2" style="color: #DD4B39"></i>Google</a>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="nav-register" role="tabpanel" aria-labelledby="nav-register-tab">
                        <h4 class="fs-34 text-center mb-6">Sign Up</h4>
                        <p class="text-center fs-16 mb-7">Already have an account? <a href="#" class="text-secondary border-bottom text-decoration-none">Log in</a></p>
                        <form>
                            <input name="first-name" type="text" class="form-control border-0 mb-3" placeholder="First name" required>
                            <input name="last-name" type="text" class="form-control border-0 mb-3" placeholder="Last name" required>
                            <input name="email" type="email" class="form-control border-0 mb-3" placeholder="Your email" required>
                            <input name="password" type="password" class="form-control border-0" placeholder="Password" required>
                            <div class="custom-control custom-checkbox mt-4 mb-5 mr-xl-6">
                                <input name="agree" type="checkbox" class="custom-control-input" id="termsOfUse">
                                <label class="custom-control-label text-body" for="termsOfUse">
                                    Yes, I agree with Grace <a href="#">Privacy Policy</a> and <a href="#">Terms of
                                        Use</a>
                                </label>
                            </div>
                            <button type="submit" value="Login" class="btn btn-secondary btn-block bg-hover-primary border-hover-primary">Sign
                                Up</button>
                            <div class="border-bottom mt-6"></div>
                            <div class="text-center mt-n2 lh-1 mb-4">
                                <span class="fs-14 bg-white lh-1 mt-n2 px-4">or Sign Up with</span>
                            </div>
                            <div class="d-flex">
                                <a href="#" class="btn btn-outline-secondary btn-block border-2x border mr-5 border-hover-secondary"><i class="fab fa-facebook-f mr-2" style="color: #2E58B2"></i>Facebook</a>
                                <a href="#" class="btn btn-outline-secondary btn-block border-2x border mt-0 border-hover-secondary"><i class="fab fa-google mr-2" style="color: #DD4B39"></i>Google</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade quick-view" id="quick-view" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0 py-0">
                <button type="button" class="close fs-32" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pt-0">
                <div class="row">
                    <div class="col-md-6 pr-xl-5 mb-8 mb-md-0 pl-xl-8">
                        <div class="galleries-product product galleries-product-02 position-relative">
                            <div class="position-absolute pos-fixed-top-right z-index-2">
                                <div class="content-change-vertical">
                                    <a href="" data-toggle="tooltip" data-placement="left" title="Add to wishlist" class="add-to-wishlist d-flex align-items-center justify-content-center text-secondary bg-white hover-white bg-hover-secondary w-48px h-48px rounded-circle mt-3 mr-3">
                                        <svg class="icon icon-star-light fs-24">
                                            <use xlink:href="#icon-star-light"></use>
                                        </svg>
                                    </a>
                                    <!-- <a href="" data-toggle="tooltip" data-placement="left" title="Compare"
                                            class="add-to-compare d-flex align-items-center justify-content-center text-secondary bg-white hover-white bg-hover-secondary w-48px h-48px rounded-circle mt-2 mr-3">
                                            <svg class="icon icon-arrows-left-right-light fs-24">
                                                <use xlink:href="#icon-arrows-left-right-light"></use>
                                            </svg>
                                        </a> -->
                                </div>
                            </div>
                            <div class="view-slider-for mx-0">
                                <div class="box px-0">
                                    <div class="card p-0 rounded-0 border-0">
                                        <a href="images/rings/IMG_20230220_151206.jpg" class="card-img product-image">
                                            <img src="images/rings/IMG_20230220_151206.jpg" alt="product gallery product-image">
                                        </a>
                                    </div>
                                </div>
                                <div class="box px-0">
                                    <div class="card p-0 rounded-0 border-0">
                                        <a href="images/Necklaces/1/Necklaces_1_500x500.jpg" class="card-img">
                                            <img src="images/Necklaces/1/Necklaces_1_500x500.jpg" alt="product gallery">
                                        </a>
                                    </div>
                                </div>
                                <div class="box px-0">
                                    <div class="card p-0 rounded-0 border-0">
                                        <a href="images/bracelet/01/01.jpg" class="card-img">
                                            <img src="images/bracelet/01/01.jpg" alt="product gallery">
                                        </a>
                                    </div>
                                </div>
                                <div class="box px-0">
                                    <div class="card p-0 rounded-0 border-0">
                                        <a href="images/pendent/1.jpg" class="card-img">
                                            <img src="images/pendent/1.jpg" alt="product gallery">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="view-slider-nav mx-n1">
                                <div class="box py-4 px-1 cursor-pointer">
                                    <img src="images/rings/IMG_20230220_151206.jpg" alt="product gallery">
                                </div>
                                <div class="box py-4 px-1 cursor-pointer">
                                    <img src="images/Necklaces/1/Necklaces_1_500x500.jpg" alt="product gallery">
                                </div>
                                <div class="box py-4 px-1 cursor-pointer">
                                    <img src="images/bracelet/01/01.jpg" alt="product gallery">
                                </div>
                                <div class="box py-4 px-1 cursor-pointer">
                                    <img src="images/pendent/1.jpg" alt="product gallery">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 pl-xl-6 pr-xl-8">
                        <p class="d-flex align-items-center mb-3"> 
                            <span class="fs-18 text-secondary font-weight-bold ml-3 ProductPrize">₹ 3,58,755</span>
                            <span class="badge badge-primary fs-16 ml-4 font-weight-600 px-3">20%</span>
                        </p>
                        <h2 class="fs-24 mb-2 product-title">Geometric Fleur CZ Diamond Ring</h2>
                        <p class="test"> 55</p>
                        <div class="d-flex align-items-center flex-wrap mb-3 lh-12">
                            <p class="mb-0 font-weight-600 text-secondary">4.86</p>
                            <ul class="list-inline d-flex mb-0 px-3 rating-result">
                                <li class="list-inline-item mr-0">
                                    <span class="text-primary fs-12 lh-2"><i class="fas fa-star"></i></span>
                                </li>
                                <li class="list-inline-item mr-0">
                                    <span class="text-primary fs-12 lh-2"><i class="fas fa-star"></i></span>
                                </li>
                                <li class="list-inline-item mr-0">
                                    <span class="text-primary fs-12 lh-2"><i class="fas fa-star"></i></span>
                                </li>
                                <li class="list-inline-item mr-0">
                                    <span class="text-primary fs-12 lh-2"><i class="fas fa-star"></i></span>
                                </li>
                                <li class="list-inline-item mr-0">
                                    <span class="text-primary fs-12 lh-2"><i class="fas fa-star"></i></span>
                                </li>
                            </ul>
                            <a href="" class="pl-3 border-left border-gray-2 text-body">Read 2947 reviews</a>
                        </div>
                        <p class="mb-4 mr-xl-6">A diamond ring is a type of jewelry that features one or more
                            diamonds mounted onto a band, usually made of precious metals such as gold or platinum.
                        </p>
                        <p class="mb-2">
                        <form>
                            <div class="form-group shop-swatch mb-4 d-flex align-items-center">
                                <span class="font-weight-600 text-secondary mr-4">Size: </span>
                                <ul class="list-inline d-flex justify-content-start mb-0">
                                    <li class="list-inline-item mr-2 selected font-weight-600">
                                        <a href="" class="fs-14 p-2 lh-13 d-block swatches-item rounded text-decoration-none border" data-var="full size">Full size</a>
                                    </li>
                                    <li class="list-inline-item font-weight-600">
                                        <a href="" class="fs-14 p-2 lh-13 d-block swatches-item rounded text-decoration-none border" data-var="mini size">Mini size</a>
                                    </li>
                                </ul>
                                <select name="swatches" class="form-select swatches-select d-none" aria-label="Default select example">
                                    <option selected value="full size">Full size</option>
                                    <option value="mini size">Mini size</option>
                                </select>
                            </div>
                            <div class="row align-items-end no-gutters mx-n2">
                                <div class="col-sm-4 form-group px-2 mb-6">
                                    <label class="text-secondary font-weight-600 mb-3" for="quickview-number">Quantity: </label>
                                    <div class="input-group position-relative w-100">
                                        <a href="" class="down position-absolute pos-fixed-left-center pl-4 z-index-2"><i class="far fa-minus"></i></a>
                                        <input name="number" type="number" id="quickview-number" class="form-control w-100 px-6 text-center input-quality text-secondary h-60 fs-18 font-weight-bold border-0" value="1" required>
                                        <a href="" class="up position-absolute pos-fixed-right-center pr-4 z-index-2"><i class="far fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-8 mb-6 w-100 px-2">
                                    <!-- Your HTML button -->
                                    <button type="button" class="btn btn-lg fs-18 btn-secondary btn-block h-60 bg-hover-primary border-0 add-to-bag product-id">Add To Bag</button>

                                </div>
                            </div>
                        </form>
                        <div class="d-flex align-items-center flex-wrap">
                            <a href="" class="text-decoration-none font-weight-bold fs-16 mr-6 d-flex align-items-center">
                                <svg class="icon icon-star-light fs-20">
                                    <use xlink:href="#icon-star-light"></use>
                                </svg>
                                <span class="ml-2">Add to wishlist</span>
                            </a>
                            <a href="" class="text-decoration-none font-weight-bold fs-16 d-flex align-items-center">
                                <svg class="icon icon-ShareNetwork">
                                    <use xlink:href="#icon-ShareNetwork"></use>
                                </svg>
                                <span class="ml-2">Share</span>
                            </a>
                        </div>
                        <ul class="list-unstyled border-top pt-5 mt-5">
                            <li class="row mb-2">
                                <span class="d-block col-4 col-lg-2 text-secondary font-weight-600 fs-14">Sku:</span>
                                <span class="d-block col-8 col-lg-10 fs-14">SF09281</span>
                            </li>
                            <li class="row mb-2">
                                <span class="d-block col-4 col-lg-2 text-secondary font-weight-600 fs-14">Categories:</span>
                                <span class="d-block col-8 col-lg-10 fs-14">Makeup, Skincare</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
<script src="js/theme.js"></script>
<script>
    function getProducts(category_id) {
        alert("hii1")
        $.ajax({
            url: "<?php echo base_url('getProductsByCategory'); ?>",
            type: "POST",
            data: {
                category_id: category_id
            },
            dataType: "json",
            success: function(response) {
                console.log(response);
                var html = '';
                $.each(response, function(index, item) {
                    html += '<div class="col-lg-3 col-sm-6 mb-5">';
                    html += '<div class="card border-0 product">';
                    html += '<div class="position-relative">';
                    html += '<img src="<?= base_url('uploads/FeatureProduct/'); ?>' + item.image + '" alt="' + item.product_name + '">';
                    html += '<div class="card-img-overlay d-flex p-3">';
                    html += ' <div class="my-auto w-100 content-change-vertical">';
                    html += '  <a href="product-detail.html" data-toggle="tooltip" data-placement="left" title="View products" class="add-to-cart ml-auto d-flex align-items-center justify-content-center text-secondary bg-white hover-white bg-hover-secondary w-48px h-48px rounded-circle mb-2">';
                    html += '<svg class="icon icon-shopping-bag-open-light fs-24">';
                    html += '<use xlink:href="#icon-shopping-bag-open-light"></use>';
                    html += '</svg>';
                    html += '</a>';
                    html += '<a href="#" class="preview QuickView ml-auto d-md-flex align-items-center justify-content-center cursor-pointer text-secondary bg-white hover-white bg-hover-secondary w-48px h-48px rounded-circle mb-2" data-product-id="' + item.id + '">';
                    html += '<svg class="icon icon-eye-light fs-24">';
                    html += '<use xlink:href="#icon-eye-light"></use>';
                    html += '</svg>';
                    html += '</a>';
                    html += ' <a href="" data-toggle="tooltip" data-placement="left" title="Add to wishlist" class="add-to-wishlist ml-auto d-flex align-items-center justify-content-center text-secondary bg-white hover-white bg-hover-secondary w-48px h-48px rounded-circle mb-2" data-product-id=" ' + item.id + '">';
                    html += '<svg class="icon icon-star-light fs-24">';
                    html += '<use xlink:href="#icon-star-light"></use>';
                    html += '</svg>';
                    html += '</a>';

                    html += '</div>';
                    html += ' </div>';
                    html += '</div>';
                    html += '</a>';
                    html += '  <div class="card-body px-0 pt-4 text-center">';
                    html += ' <span class="fs-13 font-weight-500 text-decoration-through text-body pr-1">$39.00</span>';
                    html += '<span>' + item.prize + '</span>';
                    html += '</p>';
                    html += ' <h2 class="card-title fs-15 font-weight-500 mb-2"><a href="product-detail.html">';

                    html += ' ' + item.product_name + '';
                    html += '</a>';
                    html += '</h2>';
                    html += '</div>';
                    html += '</div>';
                    html += ' </div>';


                });
                $('#productContainer').html(html);
                $('.QuickView').on('click', function(e) {
                    alert("product")
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
                $('.add-to-bag').on('click', function(e) {
        var testElement = document.getElementsByClassName('test')[0];  
        var productId = testElement ? testElement.textContent : 'No test element found';
        $.ajax({
            url: 'add-to-cart',  
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
                        redirectUrl = 'cart-list';
                    }
                    Swal.fire({
                        icon: response.alreadyAdded ? 'info' : 'success',
                        title: 'Cart',
                        text: message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        // Redirect to the cart list page after adding the product
                        window.location.href = redirectUrl;
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
        console.log(productId);
    });
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }
</script>
<script>
    function applyPriceFilter(sort) {
        $.ajax({
            url: '/price-filter',
            type: 'GET',
            data: {
                sort: sort
            },
            dataType: 'json',
            success: function(data) {
                console.log(data)
                $('#productContainer').empty();
                $.each(data.Product, function(index, product) {
                    console.log(data.Product)
                    var productHtml = `
                        <!-- Code for a single product card -->
                        <div class="col-lg-3 col-sm-6 mb-5" >
                            <div class="card border-0 product">
                                <div class="position-relative">
                                    <img src="/uploads/FeatureProduct/${product.image}" alt="${product.product_name}">
                                    <div class="card-img-overlay d-flex p-3">
                                        <div class="my-auto w-100 content-change-vertical">
                                            <!-- Add to cart, Quick view, Add to wishlist buttons -->
                                            <a href="#" data-toggle="tooltip" data-placement="left" title="View products" class="add-to-cart ml-auto d-flex align-items-center justify-content-center text-secondary bg-white hover-white bg-hover-secondary w-48px h-48px rounded-circle mb-2">
                                                <svg class="icon icon-shopping-bag-open-light fs-24">
                                                    <use xlink:href="#icon-shopping-bag-open-light"></use>
                                                </svg>
                                            </a>
                                            <a href="#" data-toggle="tooltip" data-placement="left" title="Quick view" class="preview QuickView ml-auto d-flex align-items-center justify-content-center cursor-pointer text-secondary bg-white hover-white bg-hover-secondary w-48px h-48px rounded-circle mb-2 d-none" data-product-id="${product.id}">
                                                <span data-toggle="modal" data-target="#quick-view">
                                                    <svg class="icon icon-eye-light fs-24">
                                                        <use xlink:href="#icon-eye-light"></use>
                                                    </svg>
                                                </span>
                                            </a>
                                            <a href="#" data-toggle="tooltip" data-placement="left" title="Add to wishlist" class="add-to-wishlist ml-auto d-flex align-items-center justify-content-center text-secondary bg-white hover-white bg-hover-secondary w-48px h-48px rounded-circle mb-2" data-product-id="${product.id}">
                                                <svg class="icon icon-star-light fs-24">
                                                    <use xlink:href="#icon-star-light"></use>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body px-0 pt-4 text-center">
                                    <p class="card-text font-weight-bold fs-16 mb-1 text-secondary">
                                        <span class="fs-13 font-weight-500 text-decoration-through text-body pr-1">$39.00</span>
                                        <span>${product.prize}</span>
                                    </p>
                                    <!-- Rest of the product card content goes here -->
                                    <div class="d-flex align-items-center justify-content-center flex-wrap">
                                        <!-- Rating stars and reviews count -->
                                        <ul class="list-inline mb-0 lh-1">
                                            <li class="list-inline-item fs-12 text-primary mr-0"><i class="fas fa-star"></i></li>
                                            <li class="list-inline-item fs-12 text-primary mr-0"><i class="fas fa-star"></i></li>
                                            <li class="list-inline-item fs-12 text-primary mr-0"><i class="fas fa-star"></i></li>
                                            <li class="list-inline-item fs-12 text-primary mr-0"><i class="fas fa-star"></i></li>
                                            <li class="list-inline-item fs-12 text-primary mr-0"><i class="fas fa-star"></i></li>
                                        </ul>
                                        <span class="card-text fs-14 font-weight-400 pl-2 lh-1">2947 reviews</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    $('#productContainer').append(productHtml);
                });
                $('.add-to-wishlist').on('click', function(e) {
                    e.preventDefault();
                    var productId = $(this).data('product-id');
                    $.ajax({
                        url: 'add-to-cart',
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
                                    redirectUrl = 'cart-list';
                                }
                                Swal.fire({
                                    icon: response.alreadyAdded ? 'info' : 'success',
                                    title: 'Cart',
                                    text: message,
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(function() {
                                    // Redirect to the cart list page after adding the product
                                    window.location.href = redirectUrl;
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
                $('.add-to-bag').on('click', function(e) {
                    var testElement = document.getElementsByClassName('test')[0];
                    var productId = testElement ? testElement.textContent : 'No test element found';
                    $.ajax({
                        url: 'add-to-cart',
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
                                    redirectUrl = 'cart-list';
                                }
                                Swal.fire({
                                    icon: response.alreadyAdded ? 'info' : 'success',
                                    title: 'Cart',
                                    text: message,
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(function() {
                                    // Redirect to the cart list page after adding the product
                                    window.location.href = redirectUrl;
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
                    console.log(productId);
                });
            },
            error: function(xhr, status, error) {
                console.error('Error fetching data:', error);
            }
        });
    }
</script>
<script src="/js/home.js"></script> 
<?= $this->endSection() ?>