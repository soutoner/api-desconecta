<?php

namespace App\Db\Seeds\Models\Relationships;

use App\Db\Seeds\Models\BaseSeeder;
use App\Models\Product;
use App\Models\Pack;

class PackHasProductSeeder extends BaseSeeder
{
    protected static $n_fake_seeds = 20;

    protected static $db_seeds = [
        [
            'pack_id'   => 1,
            'product_id'  => 1,
        ],
    ];

    protected static $extra_seeds = [
        [
            'pack_id'   => 1,
            'product_id'  => 2,
        ],
    ];

    public static function GenerateFake($faker){
        return [
            'pack_id'   =>  $faker->numberBetween($min = 1, $max = Pack::count()),
            'product_id'  =>  $faker->numberBetween($min = 1, $max = Product::count()),
        ];
    }
}