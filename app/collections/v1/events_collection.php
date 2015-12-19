<?php

use \Phalcon\Mvc\Micro\Collection as MicroCollection;

$version = basename(dirname(__FILE__));
$controller_path = 'App\Controllers\\' . strtoupper($version) . '\\';

/**
 * Setup collection
 */
$events = new MicroCollection();
$events->setHandler($controller_path . 'EventsController', true);
$events->setPrefix('/api/'. $version .'/events');

/**
 * Define routes
 */
$events->get('/', 'index');
$events->post('/', 'create');
$events->put('/{id:[0-9]+}', 'update');
$events->delete('/{id:[0-9]+}', 'delete');

return $events;
