<?php

/**
 * Users Seeder
 */
$users = include 'UserSeeds.php';
foreach($users as $params){
    $user = new \User();
    $user->create($params);
}
