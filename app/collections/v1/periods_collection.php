<?php

use \Phalcon\Mvc\Micro\Collection as MicroCollection;

$version = basename(dirname(__FILE__));
$controller_path = 'App\Controllers\\' . strtoupper($version) . '\\';

/**
 * Setup collection
 */
$periods = new MicroCollection();
$periods->setHandler($controller_path . 'PeriodsController', true);
$periods->setPrefix('/api/'. $version .'/periods');

/**
 * Define routes
 */
$periods->get('/', 'index');

return $periods;
