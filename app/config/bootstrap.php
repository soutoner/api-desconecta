<?php

$config = include __DIR__ . "/test-config.php";

require __DIR__ . "/loader.php";

$di = new \Phalcon\DI\FactoryDefault();

require __DIR__ . "/services.php";

$app = new \Phalcon\Mvc\Micro($di);

/**
 * Mount routes collections
 */
$collections = include APP_PATH . '/app/collections/collections.php';
foreach ($collections as $collection) {
    $app->mount($collection);
}

return $app;
