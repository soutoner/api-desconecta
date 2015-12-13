<?php

defined('APP_PATH') || define('APP_PATH', realpath('.'));

return new \Phalcon\Config(array(
    'database' => array(
        'adapter'   => 'Mysql',
        'host'      => 'localhost',
        'username'  => 'root',
        'password'  => '',
        'dbname'    => 'desconecta_dev',
        'charset'   => 'utf8',
    ),
    'application' => array(
        'controllersDir'    => APP_PATH . '/app/Controllers/',
        'modelsDir'         => APP_PATH . '/app/Models/',
        'migrationsDir'     => APP_PATH . '/app/Db/Migrations/',
        'baseUri'           => '/api/',
    ),
    'namespaces' => array(
        'App'       => APP_PATH . '/app/',
        'Faker'     => APP_PATH . '/vendor/fzaninotto/faker/src/Faker/',
    )
));
