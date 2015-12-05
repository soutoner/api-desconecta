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
$users->get('/', 'indexAction');

return $users;