<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'HomeController::index');
$routes->get('/home', 'HomeController::index');
$routes->get('products', 'HomeController::product');  
$routes->add('categoryProduct/(:num)', 'HomeController::categoryProduct/$1');  
$routes->post('quickview', 'HomeController::QuickView'); 
$routes->post('add-to-cart', 'HomeController::addToCart');  
$routes->get('cart-list', 'HomeController::cartList'); 
$routes->post('getProductsByCategory', 'HomeController::getProductsByCategory');
$routes->get('checkout', 'HomeController::checkout',['AuthGuard' => 'auth']);  
$routes->post('checkout/addToSession', 'HomeController::addToSession');
$routes->post('checkout/removeFromSession', 'HomeController::removeFromSession'); 
$routes->post('saveAddress', 'UserController::saveAddress');
$routes->add('signup', 'UserController::index');
$routes->post('address', 'UserController::address');  
$routes->post('storeaddress', 'UserController ::storeSelectedAddress');  
$routes->post('/cart/removeFromCart', 'UserController::removeFromCart');
$routes->get('order_list', 'UserController::getUserOrders');
// $routes->get('order-details/(:num)', 'UserController::getOrderDetails/$1'); 
$routes->get('price-filter', 'HomeController::priceFilter');
$routes->get('logout', 'UserController::logout');  
$routes->add('registration', 'UserController::registration');
$routes->add('login', 'UserController::loginform');

$routes->add('verifyPayment', 'UserController::verifyPayment'); 
$routes->post('initiatePayment', 'UserController::initiatePayment'); 
$routes->post('create-order', 'PaymentController::createOrder'); 
$routes->add('clearCartItems', 'UserController::clearCartItems');




$routes->add('getOrderDetails', 'UserController::getOrderDetails');

$routes->post('placeOrder', 'UserController::placeOrder'); 
$routes->post('update_wallet','UserController::update_wallet'); 

  

$routes->post('checkout/addToSession', 'HomeController::addToSession');
$routes->add('userlogin', 'UserController::login');
$routes->get('cart-list', 'HomeController::cartList');
$routes->add('get_payment_options', 'UserController::get_payment_options');



/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
