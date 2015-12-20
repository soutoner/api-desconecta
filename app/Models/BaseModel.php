<?php


namespace App\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Behavior\Timestampable;
use App\Exceptions\ResourceNotFoundException;

class BaseModel extends Model
{
    public $created_at;

    public $updated_at;

    public function initialize()
    {
        $this->addBehavior(
            new Timestampable(
                array(
                    'beforeCreate' => array(
                        'field'  => array(
                            'created_at',
                            'updated_at',
                        ),
                        'format' => 'Y-m-d H:i:s'
                    )
                )
            )
        );

        $this->addBehavior(
            new Timestampable(
                array(
                    'beforeUpdate' => array(
                        'field'  => 'updated_at',
                        'format' => 'Y-m-d H:i:s'
                    )
                )
            )
        );
    }

    /**
     * FindFirst that throws an ResourceNotFoundException.
     *
     * @param  null   $parameters
     * @param  string $resource_id
     * @return Model
     * @throws ResourceNotFoundException
     */
    public static function findFirstOrFail($parameters = null, $resource_id = null)
    {
        $result = parent::findFirst($parameters);

        if ($resource_id == null) {
            $full_path = explode('\\', get_called_class());
            $resource_id = end($full_path);
        }

        if (empty($result)) {
            throw new ResourceNotFoundException($resource_id . ' Not Found');
        } else {
            return $result;
        }
    }

    /**
     * Returns Base Class name of child being called.
     *
     * @return mixed : App\Models\User -> User
     */
    public function className()
    {
        $full_path = explode('\\', get_called_class());
        return end($full_path);
    }
}
