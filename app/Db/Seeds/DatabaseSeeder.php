<?php

namespace App\Db\Seeds;


class DatabaseSeeder
{
    /**
     * Call here Models seeders;
     */
    public static function Seed(){
        UserSeeder::Seed();
    }
}