<?php

include 'server.php';

/**
 * Command that seeds the development database.
 */
App\Db\Seeds\DatabaseSeeder::Seed();

echo "Seeding finished succesfully \n";