<?php

namespace App\Db\Seeds\Models;

use App\Db\Seeds\Models\BaseSeeder;

class MusicTagSeeder extends BaseSeeder
{
    protected static $n_fake_seeds;

    protected static $db_seeds = [
        [
            'id'    => 1,
            'value' => 'reggeton',
        ], [
            'id'    => 2,
            'value' => 'electronica',
        ],
    ];

    protected static $extra_seeds = [
        [
            'value' => 'musica clasica',
        ],
    ];

    public static function GenerateFake($faker)
    {
        return [
            'value' => $faker->name,
        ];
    }
}