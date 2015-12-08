<?php

namespace App\Db\Seeds;

use App\Models\User;

class UserSeeder
{
    /**
     * Define Users here
     *
     * @var array
     */
    protected static $user_params = [
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

    public static function Seed(){
        foreach(self::$user_params as $params){
            $user = new User();
            $user->create($params);
        }
    }

}