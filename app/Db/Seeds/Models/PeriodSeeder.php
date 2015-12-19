<?php

namespace App\Db\Seeds\Models;

use App\Db\Seeds\Models\BaseSeeder;

class PeriodSeeder extends BaseSeeder
{
    protected static $n_fake_seeds = 5;

    // Inserted in the migration.
    protected static $db_seeds = [];

    protected static $extra_seeds = [
        [
            'type'  => 'weekyearly',
        ],
    ];

    public static function GenerateFake($faker)
    {
        return [
            'type'  => $faker->name.'ly',
        ];
    }
}