<?php

namespace App\Db\Seeds\Models;

use App\Db\Seeds\Models\BaseSeeder;

class ProviderSeeder extends BaseSeeder
{
    protected static $n_fake_seeds = 5;

    // Inserted in the migration.
    protected static $db_seeds = [];

    protected static $extra_seeds = [
        [
            'name'  => 'flickr',
        ],
    ];

    public static function GenerateFake($faker)
    {
        return [
            'name'  => $faker->name.' provider',
        ];
    }
}