<?php


namespace App\Lib\OAuth;

use OAuth2\Storage\Pdo;
use App\Models\User;

class ApiStorage extends Pdo
{
    public function __construct($connection, $config = array())
    {
        parent::__construct($connection, $config);
        // Set custom User table
        $user = new User();
        $this->config['user_table'] = $user->getSource();
    }

    public function getUser($user_id)
    {
        $stmt = $this->db->prepare($sql = sprintf('SELECT * from %s where id=:user_id', $this->config['user_table']));
        $stmt->execute(array('user_id' => $user_id));

        if (!$userInfo = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            return false;
        }

        return array_merge(array(
            'user_id' => $user_id
        ), $userInfo);
    }
}
