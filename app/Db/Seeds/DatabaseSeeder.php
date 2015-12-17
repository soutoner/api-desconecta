<?php

namespace App\Db\Seeds;

use App\Db\Seeds\Models\EventSeeder;
use App\Db\Seeds\Models\GuestListSeeder;
use App\Db\Seeds\Models\LocalSeeder;
use App\Db\Seeds\Models\RRPPSeeder;
use App\Db\Seeds\Models\SchedulingSeeder;
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
        RRPPSeeder::Seed($want_fake);
        UserSeeder::Seed($want_fake);
        ProfileSeeder::Seed($want_fake);
        LocalSeeder::Seed($want_fake);
        SchedulingSeeder::Seed($want_fake);
        GuestListSeeder::Seed($want_fake);
        EventSeeder::Seed($want_fake);
        /**
         * Relationships.
         */
        FollowerSeeder::Seed($want_fake);
    }
}