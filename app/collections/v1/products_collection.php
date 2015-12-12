<?php

use \Phalcon\Mvc\Micro\Collection as MicroCollection;

$version = basename(dirname(__FILE__));
$controller_path = 'App\Controllers\\' . strtoupper($version) . '\\';

/**
 * Setup collection
 */
$packs = new MicroCollection();
$packs->setHandler($controller_path . 'PacksController', true);
$packs->setPrefix('/api/'. $version .'/packs');

/**
 * Define routes
 */
$packs->get('/', 'index');
$packs->post('/', 'create');
$packs->put('/{id:[0-9]+}', 'update');
$packs->delete('/{id:[0-9]+}', 'delete');

return $packs;
