<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.


$routes->get('/', 'Home::index');
$routes->get('/book', 'Book::index');
$routes->get('/book/create', 'Book::create');
$routes->post('/book/create', 'Book::save');
$routes->get('/book/edit/(:any)', 'Book::edit/$1');
$routes->post('/book/edit/(:any)', 'Book::update/$1');
$routes->get('/book/(:any)', 'Book::detail/$1');
$routes->delete('/book/(:num)', 'Book::delete/$1');

$routes->get('/', 'Home::index');
$routes->get('/komik', 'Komik::index');
$routes->get('/komik/create', 'Komik::create');
$routes->post('/komik/create', 'Komik::save');
$routes->get('/komik/edit/(:any)', 'Komik::edit/$1');
$routes->post('/komik/edit/(:any)', 'Komik::update/$1');
$routes->get('/komik/(:any)', 'Komik::detail/$1');
$routes->delete('/komik/(:num)', 'Komik::delete/$1');



$routes->get('/coba', function () {

    echo 'Hello World!';
});

$routes->get('/coba/(:any)', 'Home::about/$1');

$routes->addPlaceholder('uuid', '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}');
$routes->get('coba2/(:uuid)', function ($uuid) {
    echo "UUID: $uuid";
});

$routes->get('/', 'Home::index');
$routes->get('/coba/(:any)/(:num)', 'Home::about/$1/$2');
$routes->get('/users', 'Admin\Users::index');
$routes->get('/master', 'Admin\Master::index');

$routes->group('adm', function ($r) {
    $r->get('users', 'Admin\Users::index');
    $r->get('master', 'Admin\Master::index');
    $r->get('Container', 'Admin\Container::index');
    $r->get('/', 'Tugas2::index');
});
$routes->get('/', 'Home::Bio');
$routes->get('/', 'Home::Contact');
$routes->get('/', 'Home::About');

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
