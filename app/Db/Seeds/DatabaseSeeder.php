<?php

namespace App\Db\Seeds;

use App\Db\Seeds\Models\UserSeeder;
use App\Db\Seeds\Models\ProfileSeeder;
use App\Db\Seeds\Models\Relationships\FollowerSeeder;

class DatabaseSeeder
{
    /**
     * Call here Models seeders;
     * @param bool $want_fake : Whether to create fake users or not
     */
    public static function Seed($want_fake=true)
    {
        /**
         * Models.
         */
        UserSeeder::Seed($want_fake);
        ProfileSeeder::Seed($want_fake);
        /**
         * Relationships.
         */
        if ($want_fake) {
            FollowerSeeder::Seed();
        }
    }
}