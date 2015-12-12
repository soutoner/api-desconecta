<?php

use \Phalcon\Mvc\Micro\Collection as MicroCollection;

$version = basename(dirname(__FILE__));
$controller_path = 'App\Controllers\\' . strtoupper($version) . '\\';

/**
 * Setup collection
 */
$locals = new MicroCollection();
$locals->setHandler($controller_path . 'LocalsController', true);
$locals->setPrefix('/api/'. $version .'/locals');

/**
 * Define routes
 */
$locals->get('/', 'index');
$locals->post('/', 'create');
$locals->put('/{id:[0-9]+}', 'update');
$locals->delete('/{id:[0-9]+}', 'delete');

return $locals;
