<?php

use \Phalcon\Mvc\Micro\Collection as MicroCollection;

$version = basename(dirname(__FILE__));
$controller_path = 'App\Controllers\\' . strtoupper($version) . '\\';

/**
 * Setup collection
 */
$schedulings = new MicroCollection();
$schedulings->setHandler($controller_path . 'SchedulingsController', true);
$schedulings->setPrefix('/api/'. $version .'/schedulings');

/**
 * Define routes
 */
$schedulings->get('/', 'index');
$schedulings->post('/', 'create');
$schedulings->put('/{id:[0-9]+}', 'update');
$schedulings->delete('/{id:[0-9]+}', 'delete');

return $schedulings;
