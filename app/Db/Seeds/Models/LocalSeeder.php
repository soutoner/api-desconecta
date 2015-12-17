<?php

namespace App\Db\Seeds\Models;

use App\Db\Seeds\Models\BaseSeeder;
use App\Models\RRPP;

class LocalSeeder extends BaseSeeder
{
    protected static $n_fake_seeds;

    protected static $db_seeds = [
        [
            'id'            => 1,
            'name'          => 'DB pub',
            'desc'          => 'Local que solo existe in the database',
            'photo_cover'   => 'http://foo.com',
            'geo'           => '42,5 - 16.1',
            'address'       => 'Calle sin numero 567',
            'owner_id'      => 1,
        ], [
            'id'            => 2,
            'name'          => 'DB pub2',
            'desc'          => 'Local que solo ',
            'photo_cover'   => 'http://foo.com',
            'geo'           => '43,5 - 18.1',
            'address'       => 'Calle sin 567',
            'owner_id'      => 1,
        ],
    ];

    protected static $extra_seeds = [
        [
            'name'          => 'Yosua',
            'desc'          => 'Local pa beber hasta doler',
            'photo_cover'   => 'http://foo.com',
            'geo'           => '42,3 - 15.1',
            'address'       => 'Calle sin numero 123',
            'owner_id'      => 1,
        ],
    ];

    public static function GenerateFake($faker){
        return [
            'name'          => $faker->company,
            'desc'          => $faker->text($maxNbChars = 200),
            'photo_cover'   => $faker->imageUrl($width = 640, $height = 480),
            'geo'           => $faker->latitude.' '.$faker->longitude,
            'address'       => $faker->streetAddress,
            'owner_id'      => $faker->numberBetween($min = 1, $max = RRPP::count()),
        ];
    }
}