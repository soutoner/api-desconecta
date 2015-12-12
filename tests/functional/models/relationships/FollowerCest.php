<?php

namespace models\relationships;

use \FunctionalTester;
use App\Models\User;
use App\Models\Relationships\Follower;
use App\Db\Seeds\Models\UserSeeder;

class FollowerCest
{
    protected $user;

    protected $follower;

    public function _before(FunctionalTester $I)
    {
        $this->user = User::findFirst();
        $this->follower = User::findFirst(["email = '". UserSeeder::DbSeeds()[1]['email'] ."'"]);

        $rel = new Follower();
        $rel->create([
            'user_id'       => $this->user->id,
            'follower_id'   => $this->follower->id,
        ]);
    }

    public function _after(FunctionalTester $I)
    {
    }

    public function followersRelationshipSuccessful(FunctionalTester $I)
    {
        $I->assertEquals($this->user->getFollowers()->getFirst()->email, $this->follower->email);
        $I->assertEquals($this->follower->getFollowing()->getFirst()->email, $this->user->email);
        $I->assertEmpty($this->user->getFollowing());
    }

    public function deleteFollowersRelationshipSuccessful(FunctionalTester $I)
    {
        $I->assertEquals($this->user->getFollowers()->getFirst()->email, $this->follower->email);
        Follower::findFirst(
            ['user_id = '. $this->user->id,
            'folower_id = '. $this->follower->id]
        )->delete();
        $I->assertEmpty($this->user->getFollowers());
        $I->assertEmpty($this->follower->getFollowing());
    }

    public function folowersAreUnique(FunctionalTester $I)
    {
        $rel = new Follower();
        $I->assertFalse(
            $rel->create([
                'user_id'       => $this->user->id,
                'follower_id'   => $this->follower->id,
            ])
        );
    }

    public function youCantFollowYourself(FunctionalTester $I)
    {
        $rel = new Follower();
        $I->assertFalse(
            $rel->create([
                'user_id'       => $this->user->id,
                'follower_id'   => $this->user->id,
            ])
        );
    }
}
