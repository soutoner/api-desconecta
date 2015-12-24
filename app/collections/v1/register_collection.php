<?php

use \Phalcon\Mvc\Micro\Collection as MicroCollection;

$version = basename(dirname(__FILE__));
$controller_path = 'App\Controllers\\' . strtoupper($version) . '\\';

/**
 * Setup collection
 */
$collection = new MicroCollection();
$collection->setHandler($controller_path . 'RegisterController', true);
$collection->setPrefix('/api/'. $version .'/register');

/**
 * Define routes
 */
$collection->get('/facebook', 'getAuthFacebook');
$collection->get('/facebook/callback', 'facebookCallback');


return $collection;
