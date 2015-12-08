<?php

namespace models\relationships;

use \FunctionalTester;
use App\Models\User;
use App\Db\Seeds\UserSeeder;

class FollowerCest
{
    public function _before(FunctionalTester $I)
    {
    }

    public function _after(FunctionalTester $I)
    {
    }

    public function followersRelationshipSuccessful(FunctionalTester $I)
    {
        $user = User::findFirst();
        $follower = User::findFirst(["email = '". UserSeeder::DbUserSeeds()[1]['email'] ."'"]);

        $user->followers = [$follower];
        $user->update();

        $I->assertEquals($user->getFollowers()->getFirst()->email, $follower->email);
        $I->assertEquals($follower->getFollowing()->getFirst()->email, $user->email);
        $I->assertEmpty($user->getFollowing());
    }
}
