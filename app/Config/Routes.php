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
$routes->get('/', 'Home::index');
$routes->get('/products', 'ProductController::index');
$routes->get('ajax-datatable', 'ProductController::ajaxDataTables');
$routes->get('/dashboard', 'DashboardController::index');

$routes->get("fullcalendar", "DashboardController::index");
$routes->get("booking", "DashboardController::loadData");
$routes->post("bookingAjax", "DashboardController::ajax");

// ===============POST 
// List all posts
$routes->get('posts', 'PostController::index');
// Show a single post
$routes->get('posts/(:num)', 'PostController::show/$1');
// Open a new post page
$routes->get('posts/create', 'PostController::create');
// Create a new post
$routes->post('posts/store', 'PostController::store');
$routes->get('posts/edit/(:num)', 'PostController::edit/$1');
$routes->post('posts/update/(:num)', 'PostController::update/$1');
$routes->delete('posts/delete/(:num)', 'PostController::delete/$1');
// ===============End POST 

// =============== Airplane
// List all airplanes
$routes->get('airplanes', 'AirplaneController::index');
// =============== End Airplane

// ===============ROOM 
// List all rooms
$routes->get('rooms', 'RoomController::index');
// Show a single rooms
$routes->get('rooms/(:num)', 'RoomController::show/$1');
// Open a new rooms page
$routes->get('rooms/create', 'RoomController::create');
// Create a new rooms
$routes->post('rooms/store', 'RoomController::store');
$routes->get('rooms/edit/(:num)', 'RoomController::edit/$1');
$routes->post('rooms/update/(:num)', 'RoomController::update/$1');
$routes->delete('rooms/delete/(:num)', 'RoomController::delete/$1');
$routes->get('rooms/export-excel', 'RoomController::export');
$routes->get('rooms/template-excel', 'RoomController::template_excel');
$routes->post('rooms/import-excel', 'RoomController::import');
// ===============End ROOM 


$routes->resource('api', ['controller' => 'API\ApiController']);


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
