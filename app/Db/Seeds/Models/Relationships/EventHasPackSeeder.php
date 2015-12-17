<?php

namespace App\Db\Seeds\Models\Relationships;

use App\Db\Seeds\Models\BaseSeeder;
use App\Models\Pack;
use App\Models\Event;

class EventHasPackSeeder extends BaseSeeder
{
    protected static $n_fake_seeds = 20;

    protected static $db_seeds = [
        [
            'event_id'   => 1,
            'pack_id'  => 1,
        ],
    ];

    protected static $extra_seeds = [
        [
            'event_id'   => 1,
            'pack_id'  => 2,
        ],
    ];

    public static function GenerateFake($faker){
        return [
            'event_id'   =>  $faker->numberBetween($min = 1, $max = Event::count()),
            'pack_id'  =>  $faker->numberBetween($min = 1, $max = Pack::count()),
        ];
    }
}