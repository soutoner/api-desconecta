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
        'baseUri'   => '/api/',
    ),
    'namespaces' => array(
        'App'       => APP_PATH . '/app/',
    )
));
