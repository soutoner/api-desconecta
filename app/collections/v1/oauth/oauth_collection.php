<?php

use \Phalcon\Mvc\Micro\Collection as MicroCollection;

$version = basename(dirname(__DIR__));
$controller_path = 'App\Controllers\\' . strtoupper($version) . '\\OAuth\\';

/**
 * Setup collection
 */
$collection = new MicroCollection();
$collection->setHandler($controller_path . 'OAuthController', true);
$collection->setPrefix('/api/'. $version .'/oauth');

/**
 * Define routes
 */
$collection->post('/token', 'getToken');

return $collection;
