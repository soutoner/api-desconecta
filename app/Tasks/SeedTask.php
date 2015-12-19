<?php

namespace App\Tasks;

use App\Db\Seeds\DatabaseSeeder;

class SeedTask extends \Phalcon\CLI\Task
{
    public function mainAction()
    {
        DatabaseSeeder::Seed();

        echo "Database is successfully seeded \n";
    }
}
