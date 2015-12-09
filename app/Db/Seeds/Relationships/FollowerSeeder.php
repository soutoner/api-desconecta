<?php

namespace App\Db\Seeds\Relationships;

use App\Models\User;
use App\Models\Relationships\Follower;
use Faker\Factory;

class FollowerSeeder
{
    /**
     * Number of relationships to be created.
     *
     * @var int
     */
    protected static $n_of_relationships = 15;

    public static function Seed(){
        $user_ids = [];
        foreach(User::find()->toArray() as $user_params){
            $user_ids[] = $user_params['id'];
        }

        $faker = Factory::create();
        for($i = 0; $i < self::$n_of_relationships; $i++){
            $rel = new Follower();
            $rel->create([
                'user_id'       => $faker->randomElement($user_ids),
                'follower_id'   => $faker->randomElement($user_ids),
            ]);
        }
    }
}