<?php

/**
 * Define routes collections
 */
$collections = [
    require APP_PATH . '/app/collections/v1/users_collection.php',
    require APP_PATH . '/app/collections/v1/events_collection.php',
    require APP_PATH . '/app/collections/v1/locals_collection.php',
    require APP_PATH . '/app/collections/v1/guestLists_collection.php',
    require APP_PATH . '/app/collections/v1/followers_collection.php',
    require APP_PATH . '/app/collections/v1/hashTags_collection.php',
    require APP_PATH . '/app/collections/v1/musicTags_collection.php',
    require APP_PATH . '/app/collections/v1/packs_collection.php',
    require APP_PATH . '/app/collections/v1/periods_collection.php',
    require APP_PATH . '/app/collections/v1/photos_collection.php',
    require APP_PATH . '/app/collections/v1/products_collection.php',
    require APP_PATH . '/app/collections/v1/schedulings_collection.php',
    require APP_PATH . '/app/collections/v1/register_collection.php',
];

return $collections;
