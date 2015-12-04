<?php

error_reporting(E_ALL);

define('APP_PATH', realpath('.'));

try {

    /**
     * Read the configuration
     */
    $config = include APP_PATH . "/app/config/config.php";

    /**
     * Read auto-loader
     */
    include APP_PATH . "/app/config/loader.php";

    /**
     * Read services
     */
    include APP_PATH . "/app/config/services.php";

    /**
     * Handle the request
     */
    $app = new \Phalcon\Mvc\Micro($di);

    /**
     * Adding route collections
     */
    foreach (glob(APP_PATH . "/app/endpoints/v1/*.php") as $filename)
    {
        include $filename;
    }

    $app->handle();

} catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
