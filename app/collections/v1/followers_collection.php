<?php

use \Phalcon\Mvc\Micro\Collection as MicroCollection;

$version = basename(dirname(__FILE__));
$controller_path = 'App\Controllers\\' . strtoupper($version) . '\\';

/**
 * Setup collection
 */
$collection = new MicroCollection();
$collection->setHandler($controller_path . 'FollowersController', true);
$collection->setPrefix('/api/'. $version .'/followers');

/**
 * Define routes
 */
$collection->get('/{id:[0-9]+}', 'index');
$collection->post('/{id:[0-9]+}', 'create');
$collection->delete('/{id:[0-9]+}', 'delete');

return $collection;
