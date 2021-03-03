<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Website');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->post('/website', 'Website::index',['filter'=>'noauth']);
$routes->post('/', 'Login::index',['filter'=>'noauth']);
$routes->post('/login', 'Login::index',['filter'=>'noauth']);
$routes->post('/check', 'Login/check::index',['filter'=>'noauth']);
$routes->post('/admin', 'Admin::index',['filter'=>'auth']);
$routes->post('/admin/getuserbyemail', 'Admin::getuserbyemail',['filter'=>'auth']);
$routes->post('/admin/profil', 'Admin::profil',['filter'=>'auth']);
$routes->post('/admin/updateprofil', 'Admin::updateprofil',['filter'=>'auth']);
$routes->post('/admin/users', 'Admin::users',['filter'=>'auth']);
$routes->get('/admin/getusers', 'Admin::getusers',['filter'=>'auth']);
$routes->post('/admin/addadmin', 'Admin::addadmin',['filter'=>'auth']);
$routes->get('/admin/saveusers', 'Admin::saveusers',['filter'=>'auth']);
$routes->get('/admin/resetuser', 'Admin::resetuser',['filter'=>'auth']);
$routes->get('/admin/deleteduser', 'Admin::deleteduser',['filter'=>'auth']);
$routes->post('/admin/level', 'Admin::level',['filter'=>'auth']);
$routes->get('/admin/getlevel', 'Admin::getlevel',['filter'=>'auth']);
$routes->post('/admin/addlevel', 'Admin::getlevel',['filter'=>'auth']);
$routes->get('/admin/editlevel', 'Admin::editlevel',['filter'=>'auth']);
$routes->get('/admin/savelevel', 'Admin::savelevel',['filter'=>'auth']);
$routes->get('/admin/updatelevel', 'Admin::updatelevel',['filter'=>'auth']);
$routes->get('/admin/deletedlevel', 'Admin::deletedlevel',['filter'=>'auth']);

$routes->post('/admin/kategori', 'Admin::kategori',['filter'=>'auth']);
$routes->get('/admin/getkategori', 'Admin::getkategori',['filter'=>'auth']);
$routes->post('/admin/addkategori', 'Admin::addkategori',['filter'=>'auth']);
$routes->get('/admin/editkategori', 'Admin::editkategori',['filter'=>'auth']);
$routes->get('/admin/savekategori', 'Admin::savekategori',['filter'=>'auth']);
$routes->get('/admin/updatekategori', 'Admin::updatekategori',['filter'=>'auth']);
$routes->get('/admin/deletedkategori', 'Admin::deletedkategori',['filter'=>'auth']);

$routes->post('/admin/halaman', 'Admin::halaman',['filter'=>'auth']);
$routes->get('/admin/gethalaman', 'Admin::gethalaman',['filter'=>'auth']);
$routes->post('/admin/addhalaman', 'Admin::addhalaman',['filter'=>'auth']);
$routes->get('/admin/edithalaman', 'Admin::edithalaman',['filter'=>'auth']);
$routes->get('/admin/savehalaman', 'Admin::savehalaman',['filter'=>'auth']);
$routes->get('/admin/updatehalaman', 'Admin::updatehalaman',['filter'=>'auth']);
$routes->get('/admin/deletedhalaman', 'Admin::deletedhalaman',['filter'=>'auth']);

$routes->post('/admin/berita', 'Admin::berita',['filter'=>'auth']);
$routes->get('/admin/getberita', 'Admin::getberita',['filter'=>'auth']);
$routes->post('/admin/addberita', 'Admin::addberita',['filter'=>'auth']);
$routes->get('/admin/editberita', 'Admin::editberita',['filter'=>'auth']);
$routes->get('/admin/saveberita', 'Admin::saveberita',['filter'=>'auth']);
$routes->get('/admin/updateberita', 'Admin::updateberita',['filter'=>'auth']);
$routes->get('/admin/deletedberita', 'Admin::deletedberita',['filter'=>'auth']);

$routes->post('/admin/videos', 'Admin::videos',['filter'=>'auth']);
$routes->get('/admin/getvideos', 'Admin::getvideos',['filter'=>'auth']);
$routes->post('/admin/addvideo', 'Admin::addvideo',['filter'=>'auth']);
$routes->get('/admin/editvideo', 'Admin::editvideo',['filter'=>'auth']);
$routes->get('/admin/savevideo', 'Admin::savevideo',['filter'=>'auth']);
$routes->get('/admin/updatevideo', 'Admin::updatevideo',['filter'=>'auth']);
$routes->get('/admin/deletedvideo', 'Admin::deletedvideo',['filter'=>'auth']);
/**
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
