<?php

use \Phalcon\Mvc\Micro\Collection as MicroCollection;

$version = basename(dirname(__FILE__));
$controller_path = 'App\Controllers\\' . strtoupper($version) . '\\';

/**
 * Setup collection
 */
$users = new MicroCollection();
$users->setHandler($controller_path . 'UsersController', true);
$users->setPrefix('/api/'. $version .'/users');

/**
 * Define routes
 */
$users->get('/', 'index');
$users->post('/', 'create');
$users->put('/{id:[0-9]+}', 'update');
$users->delete('/{id:[0-9]+}', 'delete');

return $users;
