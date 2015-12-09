<?php

use \Phalcon\Mvc\Micro\Collection as MicroCollection;

$version = basename(dirname(__FILE__));
$controller_path = 'App\Controllers\\' . strtoupper($version) . '\\';

/**
 * Setup collection
 */
$lists = new MicroCollection();
$lists->setHandler($controller_path . 'GuestListsController', true);
$lists->setPrefix('/api/'. $version .'/guestlist');

/**
 * Define routes
 */
$lists->get('/', 'index');
$lists->post('/', 'create');
$lists->put('/{id:[0-9]+}', 'update');
$lists->delete('/{id:[0-9]+}', 'delete');

return $lists;
