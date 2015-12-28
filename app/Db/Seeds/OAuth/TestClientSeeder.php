<?php


namespace App\Db\Seeds\OAuth;


class TestClientSeeder
{
    protected static $params = [
        'client_id'     => 'testclient',
        'client_secret' => 'testsecret',
        'redirect_uri'  => 'http://foo/',
    ];

    public static function Seed()
    {
        \Phalcon\DI::getDefault()['db']
            ->query("INSERT INTO oauth_clients (client_id, client_secret, redirect_uri) VALUES ('"
                .static::$params['client_id']."', '"
                .static::$params['client_secret']."', '"
                .static::$params['redirect_uri']."')");
    }

    public static function GetParams()
    {
        return static::$params;
    }
}
