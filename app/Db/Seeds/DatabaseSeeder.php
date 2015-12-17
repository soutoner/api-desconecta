<?php

namespace App\Db\Seeds;

use App\Db\Seeds\Models\EventSeeder;
use App\Db\Seeds\Models\GuestListSeeder;
use App\Db\Seeds\Models\HashTagSeeder;
use App\Db\Seeds\Models\LocalSeeder;
use App\Db\Seeds\Models\PeriodSeeder;
use App\Db\Seeds\Models\PhotoSeeder;
use App\Db\Seeds\Models\ProductSeeder;
use App\Db\Seeds\Models\PackSeeder;
use App\Db\Seeds\Models\ProviderSeeder;
use App\Db\Seeds\Models\RRPPSeeder;
use App\Db\Seeds\Models\SchedulingSeeder;
use App\Db\Seeds\Models\UserSeeder;
use App\Db\Seeds\Models\ProfileSeeder;
use App\Db\Seeds\Models\Relationships\FollowerSeeder;
use App\Db\Seeds\Models\MusicTagSeeder;

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
        ProviderSeeder::Seed($want_fake);
        ProfileSeeder::Seed($want_fake);
        LocalSeeder::Seed($want_fake);
        PeriodSeeder::Seed($want_fake);
        SchedulingSeeder::Seed($want_fake);
        GuestListSeeder::Seed($want_fake);
        EventSeeder::Seed($want_fake);
        MusicTagSeeder::Seed($want_fake);
        HashTagSeeder::Seed($want_fake);
        ProductSeeder::Seed($want_fake);
        PackSeeder::Seed($want_fake);
        PhotoSeeder::Seed($want_fake);
        /**
         * Relationships.
         */
        FollowerSeeder::Seed($want_fake);
    }
}