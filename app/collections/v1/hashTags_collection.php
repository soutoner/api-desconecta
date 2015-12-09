<?php

use \Phalcon\Mvc\Micro\Collection as MicroCollection;

$version = basename(dirname(__FILE__));
$controller_path = 'App\Controllers\\' . strtoupper($version) . '\\';

/**
 * Setup collection
 */
$hashtags = new MicroCollection();
$hashtags->setHandler($controller_path . 'HashTagsController', true);
$hashtags->setPrefix('/api/'. $version .'/hashtags');

/**
 * Define routes
 */
$hashtags->get('/', 'index');
$hashtags->post('/', 'create');

return $hashtags;
