<?php

namespace controllers;

use \FunctionalTester;
use App\Db\Seeds\Models\UserSeeder;
use App\Models\User;

class BaseControllerCest
{
    /**
     * GET (Paginate)
     */

    public function indexReponseSuccesfullDefault(FunctionalTester $I)
    {
        $I->sendGET('/api/v1/users');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['current' => '1']);
        $I->seeResponseContains('items');
        $items = count(json_decode($I->grabResponse())->items);
        $I->assertGreaterThan(0, $items);
        $I->assertLessThanOrEqual(10, $items);
    }

    public function indexReponseSuccesfullWithPage(FunctionalTester $I)
    {
        UserSeeder::Seed(true);
        $I->sendGET('/api/v1/users', ['page' => '2']);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['current' => '2']);
        $I->seeResponseContains('items');
        $items = count(json_decode($I->grabResponse())->items);
        $I->assertGreaterThan(0, $items);
        $I->assertLessThanOrEqual(10, $items);
    }

    /**
     * POST (Create)
     */

    public function createReponseSuccesfull(FunctionalTester $I)
    {
        $user_params = UserSeeder::ExtraSeeds()[0];
        $I->sendPOST('/api/v1/users', $user_params);
        $I->seeResponseCodeIs(201);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson($user_params);
        $I->dontSeeResponseContains('messages');
    }

    public function createReponseWithErrors(FunctionalTester $I)
    {
        $user_params = UserSeeder::ExtraSeeds()[0];
        $user_params['name'] = '';
        $I->sendPOST('/api/v1/users', $user_params);
        $I->seeResponseCodeIs(409);
        $I->seeResponseIsJson();
        $I->seeResponseContains('messages');
        $I->seeResponseContains('name');
        $I->assertGreaterThan(0, count(json_decode($I->grabResponse())->messages));
    }

    /**
     * PUT (Update)
     */

    public function updateReponseSuccesfull(FunctionalTester $I)
    {
        $id = 1;
        $I->sendPUT('/api/v1/users/'.$id, ['name' => 'Pepito']);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(User::findFirst($id)->toArray());
    }

    public function updateReponseWithErrors(FunctionalTester $I)
    {
        $id = 1;
        $I->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');
        $I->sendPUT('/api/v1/users/'.$id, 'email='.User::findFirst(2)->email);
        $I->seeResponseCodeIs(409);
        $I->seeResponseIsJson();
        $I->seeResponseContains('messages');
        $I->seeResponseContains('email');
        $I->assertGreaterThan(0, count(json_decode($I->grabResponse())->messages));
    }

    public function updateReponseWhenNotFound(FunctionalTester $I)
    {
        $id = 0;
        $I->sendPUT('/api/v1/users/'.$id);
        $I->seeResponseCodeIs(404);
        $I->seeResponseIsJson();
    }

    /**
     * DELETE
     */

    public function deleteReponseSuccesfull(FunctionalTester $I)
    {
        $id = 1;
        $I->sendDELETE('/api/v1/users/'.$id);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
    }

    public function deleteReponseWhenNotFound(FunctionalTester $I)
    {
        $id = 0;
        $I->sendDELETE('/api/v1/users/'.$id);
        $I->seeResponseCodeIs(404);
        $I->seeResponseIsJson();
    }
}
