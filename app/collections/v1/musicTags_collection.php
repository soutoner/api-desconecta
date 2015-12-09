<?php

use \Phalcon\Mvc\Micro\Collection as MicroCollection;

$version = basename(dirname(__FILE__));
$controller_path = 'App\Controllers\\' . strtoupper($version) . '\\';

/**
 * Setup collection
 */
$musictags = new MicroCollection();
$musictags->setHandler($controller_path . 'MusicTagsController', true);
$musictags->setPrefix('/api/'. $version .'/musictags');

/**
 * Define routes
 */
$musictags->get('/', 'index');
$musictags->post('/', 'create');

return $musictags;
