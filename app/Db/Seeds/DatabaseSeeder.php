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
use App\Db\Seeds\Models\Relationships\AppearSeeder;
use App\Db\Seeds\Models\Relationships\AttendSeeder;
use App\Db\Seeds\Models\Relationships\BelongSeeder;
use App\Db\Seeds\Models\Relationships\EventHasHashTagSeeder;
use App\Db\Seeds\Models\Relationships\EventHasMusicTagSeeder;
use App\Db\Seeds\Models\Relationships\EventHasPackSeeder;
use App\Db\Seeds\Models\Relationships\FollowSeeder;
use App\Db\Seeds\Models\Relationships\PackHasProductSeeder;
use App\Db\Seeds\Models\Relationships\PhotoHasHashTagSeeder;
use App\Db\Seeds\Models\RRPPSeeder;
use App\Db\Seeds\Models\SchedulingSeeder;
use App\Db\Seeds\Models\UserSeeder;
use App\Db\Seeds\Models\ProfileSeeder;
use App\Db\Seeds\Models\Relationships\FollowerSeeder;
use App\Db\Seeds\Models\MusicTagSeeder;
use App\Db\Seeds\OAuth\TestClientSeeder;

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
        AppearSeeder::Seed($want_fake);
        AttendSeeder::Seed($want_fake);
        BelongSeeder::Seed($want_fake);
        FollowSeeder::Seed($want_fake);
        PhotoHasHashTagSeeder::Seed($want_fake);
        PackHasProductSeeder::Seed($want_fake);
        EventHasPackSeeder::Seed($want_fake);
        EventHasHashTagSeeder::Seed($want_fake);
        EventHasMusicTagSeeder::Seed($want_fake);

        $env = getenv('APP_ENV');
        if ($env === 'test') {
            TestClientSeeder::Seed();
        }
    }
}