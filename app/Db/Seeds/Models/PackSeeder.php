<?php

namespace App\Db\Seeds\Models;

use App\Db\Seeds\Models\BaseSeeder;

class PackSeeder extends BaseSeeder
{
    protected static $n_fake_seeds = 5;

    protected static $db_seeds = [
        [
            'id'    => 1,
            'price' => '5',
        ], [
            'id'    => 2,
            'price' => '10',
        ],
    ];

    protected static $extra_seeds = [
        [
            'price' => '40',
        ],
    ];

    public static function GenerateFake($faker)
    {
        return [
            'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = null)
        ];
    }
}