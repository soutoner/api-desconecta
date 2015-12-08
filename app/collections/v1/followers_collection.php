<?php

use \Phalcon\Mvc\Micro\Collection as MicroCollection;

$version = basename(dirname(__FILE__));
$controller_path = 'App\Controllers\\' . strtoupper($version) . '\\';

/**
 * Setup collection
 */
$users = new MicroCollection();
$users->setHandler($controller_path . 'FollowersController', true);
$users->setPrefix('/api/'. $version .'/followers');

/**
 * Define routes
 */
$users->get('/{id:[0-9]+}', 'index');
$users->post('/{id:[0-9]+}', 'create');
$users->delete('/{id:[0-9]+}', 'delete');

return $users;