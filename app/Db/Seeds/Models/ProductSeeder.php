<?php

namespace App\Db\Seeds\Models;

use App\Db\Seeds\Models\BaseSeeder;

class ProductSeeder extends BaseSeeder
{
    protected static $n_fake_seeds = 5;

    // Inserted in the migration.
    protected static $db_seeds = [];

    protected static $extra_seeds = [
        [
            'name'  => 'cachimbica',
            'icon'  => 'http://icon.com',
        ],
    ];

    public static function GenerateFake($faker){
        return [
            'name'  => $faker->name,
            'icon'  => $faker->imageUrl($width = 640, $height = 480)
        ];
    }
}