<?php

use \Phalcon\Mvc\Micro\Collection as MicroCollection;

$version = basename(dirname(__FILE__));
$controller_path = 'App\Controllers\\' . strtoupper($version) . '\\';

/**
 * Setup collection
 */
$collection = new MicroCollection();
$collection->setHandler($controller_path . 'DocsController', true);
$collection->setPrefix('/api/'. $version .'/docs');

/**
 * Define routes
 */
$collection->get('/', 'index');

return $collection;
