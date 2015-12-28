<?php

putenv("APP_ENV=test");

$config = include __DIR__.'/config.php';

require __DIR__.'/loader.php';

$di = new \Phalcon\DI\FactoryDefault();

require __DIR__.'/services.php';

$app = new \Phalcon\Mvc\Micro($di);

$app->getRouter()->setUriSource(\Phalcon\Mvc\Router::URI_SOURCE_SERVER_REQUEST_URI);

$middleware = getenv('USE_MIDDLEWARE');
if ($middleware) {
    $app->before(new App\Middleware\OAuthMiddleware());
}

/**
 * Mount routes collections
 */
$collections = include APP_PATH . '/app/collections/collections.php';
foreach ($collections as $collection) {
    $app->mount($collection);
}

return $app;
