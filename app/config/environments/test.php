<?php

return new \Phalcon\Config(
    array(
        'database' => array(
            'dbname'    => getenv('DATABASE_NAME').'_test',
        ),
    )
);
