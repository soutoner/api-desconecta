<?php

use \Phalcon\Mvc\Micro\Collection as MicroCollection;

$version = basename(dirname(__FILE__));
$controller_path = 'App\Controllers\\' . strtoupper($version) . '\\';

/**
 * Setup collection
 */
$collection = new MicroCollection();
$collection->setHandler($controller_path . 'UsersController', true);
$collection->setPrefix('/api/'. $version .'/users');

/**
 * Define routes
 */
$collection->get('/', 'index');
$collection->post('/', 'create');
$collection->get('/{id:[0-9]+}', 'show');
$collection->put('/{id:[0-9]+}', 'update');
$collection->delete('/{id:[0-9]+}', 'delete');

return $collection;
