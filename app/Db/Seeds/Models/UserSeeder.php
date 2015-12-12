<?php

namespace App\Db\Seeds\Models;

use App\Db\Seeds\Models\BaseSeeder;

class UserSeeder extends BaseSeeder
{
    /**
     * Define specific seeds that are inserted in database here.
     *
     * @var array
     */
    protected static $db_seeds = [
        [
            'name'              => 'Romeo',
            'surname'           => 'Santos',
            'email'             => 'theking@staysking.com',
            'profile_picture'   => 'http://davidclarkcause.com/wp-content/uploads/2015/05/twitter-profile.jpg',
            'date_birth'        => '1994-11-11',
            'gender'            => 'H',
            'location'          => 'Bronx, New York',
        ], [
            'name'              => 'Daddy',
            'surname'           => 'Yankee',
            'email'             => 'dy@sigueme.com',
            'profile_picture'   => 'http://www.telemundo.com/sites/nbcutelemundo/files/14-cancion-favorita-urbano-sigueme-y-te-sigo-daddy-yankee-press-photo-april-2015-billlboard-650_copy.jpg',
            'date_birth'        => '1994-11-11',
            'gender'            => 'H',
            'location'          => 'Puerto Rico',
        ],
    ];

    /**
     * Define seeds that are not inserted in database here.
     *
     * @var array
     */
    protected static $extra_seeds = [
        [
            'name'              => 'Nicky',
            'surname'           => 'Jam',
            'email'             => 'elperdon@enrique.com',
            'profile_picture'   => 'http://foo.com',
            'date_birth'        => '1981-11-11',
            'gender'            => 'H',
            'location'          => 'Boston',
        ],
    ];

    public static function GenerateFake($faker){
        return [
            'name'              => $faker->firstName,
            'surname'           => $faker->lastName,
            'email'             => $faker->unique()->email,
            'profile_picture'   => $faker->imageUrl(),
            'date_birth'        => $faker->date('Y-m-d'),
            'gender'            => $faker->optional()->randomElement(['H', 'M']),
            'location'          => $faker->city,
        ];
    }
}