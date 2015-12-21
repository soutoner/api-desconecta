<?php

namespace lib\facebook;

class FacebookTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected $facebook;

    protected $test_user;

    protected function _before()
    {
        $this->facebook = $this->tester->grabServiceFromDi('facebook');
    }

    protected function _after()
    {
        unset($this->facebook);
    }

    protected function getTestUsers()
    {
        $test_users = $this->facebook->getTestUsers();
        $this->test_user = $test_users->data[0];
    }

    /**
     * getAuthURL()
     */

    public function testGetAuthUrlReturnsSomething()
    {
        $this->tester->assertNotEmpty($this->facebook->getAuthUrl());
    }

    public function testGetAuthUrlWithoutStateAndPermissions()
    {
        $url = $this->facebook->getAuthUrl();
        $this->tester->assertNotEmpty($url);
        $this->tester->assertNotContains('&state', $url);
        $this->tester->assertContains('&scope', $url);
        $this->tester->assertContains(implode(',', $this->facebook->default_permissions), $url);
    }

    public function testGetAuthUrlWithState()
    {
        $url = $this->facebook->getAuthUrl('asd');
        $this->tester->assertNotEmpty($url);
        $this->tester->assertContains('&state=asd', $url);
    }

    public function testGetAuthUrlWithExtraPermissions()
    {
        $permissions = ['hola', 'adios'];
        $url = $this->facebook->getAuthUrl(null, $permissions);
        $this->tester->assertNotEmpty($url);
        $this->tester->assertContains('&scope=', $url);
        $this->tester->assertContains(implode(',', $this->facebook->default_permissions), $url);
        $this->tester->assertContains(implode(',', $permissions), $url);
    }

    /**
     * me
     */

    public function testMe()
    {
        $this->getTestUsers();
        $me = $this->facebook->me($this->test_user->access_token);
        $this->tester->assertEquals($this->test_user->id, $me->id);
        $this->tester->assertEquals('Open Graph Test User', $me->name);
        $this->tester->assertEquals('male', $me->gender);
    }

    /**
     * getUid
     */

    public function testGetUidTestUser()
    {
        $this->getTestUsers();
        $this->tester->assertEquals($this->test_user->id, $this->facebook->getUid($this->test_user->access_token));
    }
}
