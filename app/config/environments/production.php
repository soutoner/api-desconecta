<?php

return new \Phalcon\Config(
    array(
        'database' => array(
            'dbname'    => getenv('DATABASE_NAME').'_production',
        ),
        'application' => array(
            'domain'    => 'desconecta.com',
        ),
        'debug' => false,
    )
);
