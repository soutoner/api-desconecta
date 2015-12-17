<?php

namespace App\Db\Seeds\Models;

use App\Db\Seeds\Models\BaseSeeder;

class HashTagSeeder extends BaseSeeder
{
    protected static $n_fake_seeds;

    protected static $db_seeds = [
        [
            'id'    => 1,
            'value' => 'instamola',
        ], [
            'id'    => 2,
            'value' => 'top',
        ],
    ];

    protected static $extra_seeds = [
        [
            'value' => 'lopartimos',
        ],
    ];

    public static function GenerateFake($faker){
        return [
            'value' => $faker->name,
        ];
    }
}