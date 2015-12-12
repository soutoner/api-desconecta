<?php

use \Phalcon\Mvc\Micro\Collection as MicroCollection;

$version = basename(dirname(__FILE__));
$controller_path = 'App\Controllers\\' . strtoupper($version) . '\\';

/**
 * Setup collection
 */
$products = new MicroCollection();
$products->setHandler($controller_path . 'ProductsController', true);
$products->setPrefix('/api/'. $version .'/products');

/**
 * Define routes
 */
$products->get('/', 'index');
$products->post('/', 'create');
$products->put('/{id:[0-9]+}', 'update');
$products->delete('/{id:[0-9]+}', 'delete');

return $products;
