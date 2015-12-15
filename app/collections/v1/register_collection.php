<?php

use \Phalcon\Mvc\Micro\Collection as MicroCollection;

$version = basename(dirname(__FILE__));
$controller_path = 'App\Controllers\\' . strtoupper($version) . '\\';

/**
 * Setup collection
 */
$register = new MicroCollection();
$register->setHandler($controller_path . 'RegisterController', true);
$register->setPrefix('/api/'. $version .'/register');

/**
 * Define routes
 */
$register->get('/facebook', 'getAuthFacebook');
$register->get('/facebook/callback', 'facebookCallback');


return $register;