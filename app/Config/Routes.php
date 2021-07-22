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
$routes->setDefaultController('Main');
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
$routes->get('/', 'Main::index');
$routes->group('group', function($routes)
{
	$routes->get('(:segment)', 'Main::group/$1');
    $routes->get('(:segment)/member', 'Group::member/$1');
	$routes->get('(:segment)/quiz/create', 'Group::create_quiz/$1');
	$routes->add('(:segment)/quiz/createNew', 'Group::create_quiz_insert/$1');
	$routes->get('(:segment)/quiz/(:segment)','Quiz::index/$1/$2', ['filter' => 'loginfilter']);
	$routes->get('(:segment)/quiz/(:segment)/edit','Quiz::edit/$1/$2', ['filter' => 'loginfilter']);
	$routes->get('(:segment)/quiz/(:segment)/quest/create','Question::create/$1/$2', ['filter' => 'loginfilter']);
	$routes->add('(:segment)/quiz/(:segment)/quest/createNew','Question::createNew/$1/$2', ['filter' => 'loginfilter']);
	$routes->add('(:segment)/quiz/(:segment)/quest/uploadImage','Question::uploadImage/$1/$2', ['filter' => 'loginfilter']);
	$routes->add('(:segment)/quiz/(:segment)/attempt','Quiz::attempt/$1/$2', ['filter' => 'loginfilter']);
	$routes->add('(:segment)/quiz/(:segment)/answer/mark/(:segment)','Answer::mark/$1/$2/$3', ['filter' => 'loginfilter']);
});

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
