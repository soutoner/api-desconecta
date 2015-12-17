<?php

namespace App\Db\Seeds\Models\Relationships;

use App\Db\Seeds\Models\BaseSeeder;
use App\Models\GuestList;
use App\Models\User;

class BelongSeeder extends BaseSeeder
{
    protected static $n_fake_seeds = 20;

    protected static $db_seeds = [
        [
            'user_id'   => 2,
            'guestList_id'  => 1,
        ],
    ];

    protected static $extra_seeds = [
        [
            'user_id'   => 1,
            'guestList_id'  => 2,
        ],
    ];

    public static function GenerateFake($faker){
        return [
            'user_id'   =>  $faker->numberBetween($min = 1, $max = User::count()),
            'guestList_id'  =>  $faker->numberBetween($min = 1, $max = GuestList::count()),
        ];
    }
}