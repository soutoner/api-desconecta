<?php

namespace App\Db\Seeds\Models;


abstract class BaseSeeder
{
    /**
     * Number of Faker seeds that will be inserted.
     *
     * @var int
     */
    protected static $n_fake_seeds = 10;

    /**
     * Define specific seeds that are inserted in database here.
     *
     * @var array
     */
    protected static $db_seeds = [];

    /**
     * Define seeds that are not inserted in database here.
     *
     * @var array
     */
    protected static $extra_seeds = [];

    /**
     * Populates the database.
     *
     * @param bool $want_fake : Whether to create fake seeds or not.
     */
    public static function Seed($want_fake=true){
        $class = 'App\Models\\' . str_replace('Seeder', '', end(explode('\\', get_called_class())));
        foreach(static::$db_seeds as $params){
            $seed = new $class();
            $seed->create($params);
        }

        if($want_fake) {
            $faker = Factory::create();
            for ($i = 0; $i < static::$n_fake_seeds; $i++) {
                $seed = new User();
                $seed->create(static::GenerateFake($faker));
            }
        }
    }

    /**
     * Generate fake parameters.
     * @param $faker
     * @return
     */
    public abstract static function GenerateFake($faker);

    /**
     * Returns seeds params that are saves in database.
     *
     * @return array
     */
    public static function DbSeeds(){
        return static::$db_seeds;
    }

    /**
     * Returns seeds params that are not saved in the database.
     *
     * @return array
     */
    public static function ExtraSeeds(){
        return static::$extra_seeds;
    }
}