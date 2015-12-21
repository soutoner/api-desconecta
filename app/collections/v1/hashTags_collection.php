<?php

use \Phalcon\Mvc\Micro\Collection as MicroCollection;

$version = basename(dirname(__FILE__));
$controller_path = 'App\Controllers\\' . strtoupper($version) . '\\';

/**
 * Setup collection
 */
$collection = new MicroCollection();
$collection->setHandler($controller_path . 'HashTagsController', true);
$collection->setPrefix('/api/'. $version .'/hashtags');

/**
 * Define routes
 */
$collection->get('/', 'index');
$collection->post('/', 'create');

return $collection;
