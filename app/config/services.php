<?php
/**
 * Services are globally registered in this file
 *
 * @var \Phalcon\Config $config
 */

use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Filter;
use App\Lib\Facebook\Facebook;
use App\Lib\OAuth\ApiStorage;

/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
$di = new FactoryDefault();

/**
 * Set shared config.
 */
$di->setShared('config', function () use ($config) {
    return $config;
});

/**
 * The URL component is used to generate all kind of urls in the application.
 */
$di->setShared('url', function () use ($config) {
    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);

    return $url;
});

/**
 * Database connection is created based in the parameters defined in the configuration file.
 */
$di->setShared('db', function () use ($config) {
    $dbConfig = $config->database->toArray();
    $adapter = $dbConfig['adapter'];
    unset($dbConfig['adapter']);

    $class = 'Phalcon\Db\Adapter\Pdo\\' . $adapter;

    return new $class($dbConfig);
});

/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise.
 */
$di->setShared('modelsMetadata', function () {
    return new MetaDataAdapter();
});

/**
 * Start the session the first time some component request the session service.
 */
$di->setShared('session', function () {
    $session = new SessionAdapter();
    $session->start();
    return $session;
});

/**
 * Set OAuth2 server.
 */
$di->setShared('oauth', function () use ($config) {
    $dsn = strtolower($config->database->adapter).':dbname='.$config->database->dbname.';host='.$config->database->host;
    OAuth2\Autoloader::register();
    $storage = new ApiStorage([
        'dsn'       => $dsn,
        'username'  => $config->database->username,
        'password'  => $config->database->password,
    ]);
    $server = new OAuth2\Server($storage, [
        'allow_implicit' => true,
    ]);
    $server->addGrantType(new OAuth2\GrantType\ClientCredentials($storage));
    $server->addGrantType(new OAuth2\GrantType\AuthorizationCode($storage));

    return $server;
});

/**
 * Set Facebook API credentials.
 */
$di->setShared('facebook', function () use ($config) {
    return new Facebook([
        'app_id'        => $config->fb->appId,
        'app_secret'    => $config->fb->secret,
        'callback_uri'  => $config->application->domain.$config->application->baseUri.'v1/'.$config->fb->callback,
    ]);
});
