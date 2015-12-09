<?php

namespace App\Db\Seeds\Models;

use App\Models\User;
use Faker\Factory;

class UserSeeder
{
    /**
     * Number of Faker users that will be inserted.
     *
     * @var int
     */
    protected static $n_fake_users = 10;

    /**
     * Define specific Users that are inserted in database here.
     *
     * @var array
     */
    protected static $db_users = [
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
     * Define Users that are not inserted in database here.
     *
     * @var array
     */
    protected static $extra_users = [
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

    /**
     * Populates the database.
     *
     * @param bool $want_fake : Whether to create fake users or not.
     */
    public static function Seed($want_fake=true){
        foreach(self::$db_users as $params){
            $user = new User();
            $user->create($params);
        }

        if($want_fake) {
            $faker = Factory::create();
            for ($i = 0; $i < self::$n_fake_users; $i++) {
                $user = new User();
                $user->create([
                    'name'              => $faker->firstName,
                    'surname'           => $faker->lastName,
                    'email'             => $faker->unique()->email,
                    'profile_picture'   => $faker->imageUrl(),
                    'date_birth'        => $faker->date('Y-m-d'),
                    'gender'            => $faker->optional()->randomElement(['H', 'M']),
                    'location'          => $faker->city,
                ]);
            }
        }
    }

    /**
     * Returns User params that are saves in database.
     *
     * @return array
     */
    public static function DbUserSeeds(){
        return self::$db_users;
    }

    /**
     * Returns Users params that are not saved in the database.
     *
     * @return array
     */
    public static function UserSeeds(){
        return self::$extra_users;
    }

}