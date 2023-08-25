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
$routes->setDefaultController('AdminController');
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
<<<<<<< HEAD
$routes->get('/', 'Home::index'); 
=======
$routes->get('/', 'AdminController::login'); 
>>>>>>> 29f8a3b4fa91203b78951bc36a687aad21b112b9
$routes->add('adminsignin', 'AdminController::login'); 
$routes->add('adminsignup', 'AdminController::index');
$routes->get('adminforgotpassword', 'AdminController::forgotPassword');
$routes->post('adminforgotpassword', 'AdminController::forgotPassword');
$routes->add('setnewpassword', 'AdminController::forgotPassword');
<<<<<<< HEAD
$routes->add('dashboard', 'AdminController::list');
$routes->get('admin/edit/(:num)', 'AdminController::edit/$1');
$routes->post('admin/update', 'AdminController::update');



=======
$routes->add('adminlist', 'AdminController::list',['filter' => 'authGuard']); 
$routes->get('admin/edit/(:num)', 'AdminController::edit/$1',['filter' => 'authGuard']);
$routes->post('admin/update', 'AdminController::update',['filter' => 'authGuard']); 
$routes->get('admin/delete/(:num)', 'AdminController::delete/$1',['filter' => 'authGuard']); 
$routes->post('changepassword', 'AdminController::changePassword',['filter' => 'authGuard']); 
$routes->get('logout', 'AdminController::logout');  
// $routes->match(['get', 'post'], 'dashboard', 'AdminController::initChart');
$routes->get('dashboard', 'AdminController::dashboard'); 

$routes->get('slider', 'AdminController::slider'); 
$routes->post('sliderstore', 'AdminController::sliderStore'); 
$routes->get('slideredit/(:num)', 'AdminController::sliderEdit/$1');
$routes->post('sliderupdate', 'AdminController::sliderUpdate'); 
$routes->get('sliderdelete/(:num)', 'AdminController::sliderDelete/$1');
$routes->get('exportorder', 'OrderController::exportToCSV');



$routes->get('categorylist', 'CategoryController::index'); 
$routes->post('categorystore', 'CategoryController::store'); 
$routes->get('category/edit/(:num)', 'CategoryController::edit/$1');
$routes->post('category/update', 'CategoryController::update'); 
$routes->get('category/delete/(:num)', 'CategoryController::delete/$1');
$routes->post('/category/update-rating', 'CategoryController::updateRating');

 
$routes->get('/product', 'ProductController::index');
$routes->get('/product/getProductList', 'ProductController::getProductList');
$routes->get('/product/getProduct/(:num)', 'ProductController::getProduct/$1');
$routes->post('/product/saveProduct', 'ProductController::saveProduct');
$routes->delete('/product/deleteProduct/(:num)', 'ProductController::deleteProduct/$1');
$routes->add('product/saveRating/(:num)', 'ProductController::saveRating/$1');

$routes->add('orderlist', 'OrderController::index');
$routes->add('getOrderDetails', 'OrderController::getOrderDetails');
$routes->post('update_order_status', 'OrderController::updateOrderStatus');
$routes->post('increase_wallet', 'OrderController::increase_wallet');

// $routes->post('fetch_invoice_data', 'OrderController::fetch_invoice_data');
$routes->add('invoice/(:num)', 'OrderController::fetch_invoice_data/$1');
$routes->get('user', 'UserController::index'); 
$routes->add('userlogin', 'UserController::login_user'); 
$routes->add('orders', 'UserController::getUserOrders');  
$routes->get('order/generateQrCode/(:num)', 'OrderController::generateQrCodeUrl/$1');

$routes->get('marketing', 'MarketingController::index'); 
$routes->get('set_selected_filter/(:any)', 'MarketingController::setSelectedFilter/$1');
$routes->post('send_email', 'MarketingController::sendEmail');

// $routes->get('/', 'SendMail::index');
// $routes->match(['get', 'post'], 'SendMail/sendMail', 'SendMail::sendMail');

$routes->set404Override(function(){
    return view('404page');  
});



 
>>>>>>> 29f8a3b4fa91203b78951bc36a687aad21b112b9

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
