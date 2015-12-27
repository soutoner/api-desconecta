<?php

include __DIR__ . '/../../vendor/autoload.php';

$dot_env = new Dotenv\Dotenv(__DIR__.'/../../');
$dot_env->load();

defined('APP_PATH') || define('APP_PATH', realpath('.'));

$main_config = new \Phalcon\Config(
    array(
        'database' => array(
            'adapter'   => 'Mysql',
            'host'      => getenv('DATABASE_HOST'),
            'username'  => getenv('DATABASE_USER'),
            'password'  => getenv('DATABASE_PASS'),
            'dbname'    => getenv('DATABASE_NAME').'_dev',
            'charset'   => 'utf8',
        ),
        'application' => array(
            'controllersDir'    => APP_PATH . '/app/Controllers/',
            'modelsDir'         => APP_PATH . '/app/Models/',
            'migrationsDir'     => APP_PATH . '/app/Db/Migrations/',
            'baseUri'           => '/api/',
            'domain'            => getenv('APP_DOMAIN'),
        ),
        'namespaces' => array(
            'App'   => APP_PATH . '/app/',
            'Faker' => APP_PATH . '/vendor/fzaninotto/faker/src/Faker/',
        ),
        'fb' => array(
            'appId'     => getenv('FB_CLIENT_ID'),
            'secret'    => getenv('FB_CLIENT_SECRET'),
            'callback'  => 'register/facebook/callback',
        ),
        'debug' => true,
    )
);

// By default development environment
$env = getenv('APP_ENV');
if ($env) {
    $env_config = include APP_PATH.'/app/config/environments/'.$env.'.php';

    return $main_config->merge($env_config);
} else {
    return $main_config;
}
