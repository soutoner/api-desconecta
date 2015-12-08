<?php

namespace App\Db\Seeds;

use App\Models\User;

class UserSeeder
{
    /**
     * Define Users that are inserted in database here.
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
     */
    public static function Seed(){
        foreach(self::$db_users as $params){
            $user = new User();
            $user->create($params);
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