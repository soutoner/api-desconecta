<?php


namespace App\Models\Relationships;

use Phalcon\Mvc\Model;

class Follower extends Model
{
    public $user_id;

    public $follower_id;

    public function initialize()
    {
        $this->setSource('User_follows_User');

        $this->belongsTo(
            'user_id', 'App\Models\User', 'id',
            array(
                'alias' => 'User'
            )
        );
        $this->belongsTo(
            'follower_id', 'App\Models\User', 'id',
            array(
                'alias' => 'Follower'
            )
        );
    }
}