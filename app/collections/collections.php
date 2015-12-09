<?php

/**
 * Define routes collections
 */
$collections = [
    include APP_PATH . '/app/collections/v1/users_collection.php',
    include APP_PATH . '/app/collections/v1/events_collection.php',
    include APP_PATH . '/app/collections/v1/locals_collection.php',
    include APP_PATH . '/app/collections/v1/followers_collection.php',
];

return $collections;