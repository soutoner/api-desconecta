<?php

use \Phalcon\Mvc\Micro\Collection as MicroCollection;

$version = basename(dirname(__FILE__));
$controller_path = 'App\Controllers\\' . strtoupper($version) . '\\';

/**
 * Setup collection
 */
$collection = new MicroCollection();
$collection->setHandler($controller_path . 'MusicTagsController', true);
$collection->setPrefix('/api/'. $version .'/musictags');

/**
 * Define routes
 */
$collection->get('/', 'index');
$collection->post('/', 'create');

return $collection;
