<?php

namespace App\Db\Seeds\Models;

use App\Db\Seeds\Models\BaseSeeder;

class HashTagSeeder extends BaseSeeder
{
    protected static $n_fake_seeds;

    protected static $db_seeds = [];

    protected static $extra_seeds = [];

    public static function GenerateFake($faker){
        return [];
    }
}