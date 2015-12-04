<?php

$config = new \Phalcon\Config(array(
    "database" => array(
        "adapter" => "Mysql",
        "host" => "localhost",
        "username" => "root",
        "password" => "",
        "dbname" => "desconecta_dev"
    ),
    "phalcon" => array(
        "modelsDir" => "../models/"
    )
));