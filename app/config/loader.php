<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering PSR-4 compilant namespaces
 */
$loader->registerNamespaces(
    $config->namespaces->toArray()
)->register();
