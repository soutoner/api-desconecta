<?php

use \Phalcon\Mvc\Micro\Collection as MicroCollection;

$version = basename(dirname(__FILE__));
$controller_path = 'App\Controllers\\' . strtoupper($version) . '\\';

/**
 * Setup collection
 */
$photos = new MicroCollection();
$photos->setHandler($controller_path . 'PhotosController', true);
$photos->setPrefix('/api/'. $version .'/photos');

/**
 * Define routes
 */
$photos->get('/', 'index');
$photos->post('/', 'create');
$photos->put('/{id:[0-9]+}', 'update');
$photos->delete('/{id:[0-9]+}', 'delete');

return $photos;
