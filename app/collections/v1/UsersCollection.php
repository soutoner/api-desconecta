<?php

use \Phalcon\Mvc\Micro\Collection as MicroCollection;

$version = basename(dirname(__FILE__));

/**
 * Setup collection
 */
$users = new MicroCollection();
$users->setHandler($version . '\UsersController', true);
$users->setPrefix('/api/'. $version .'/users');

/**
 * Define routes
 */
$users->get('/', 'index');
$users->post('/', 'create');
$users->post('/{id:[0-9]+}', 'update');
$users->delete('/{id:[0-9]+}', 'delete');

return $users;