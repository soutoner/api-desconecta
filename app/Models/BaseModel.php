<?php


namespace App\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Behavior\Timestampable;
use App\Exceptions\ResourceNotFoundException;

class BaseModel extends Model
{
    public function initialize(){
        $this->addBehavior(
            new Timestampable(
                array(
                    'beforeCreate' => array(
                        'field'  => array(
                            'created_at',
                            'updated_at',
                        ),
                        'format' => 'Y-m-d H:i:sP'
                    )
                )
            )
        );

        $this->addBehavior(
            new Timestampable(
                array(
                    'beforeUpdate' => array(
                        'field'  => 'updated_at',
                        'format' => 'Y-m-d H:i:sP'
                    )
                )
            )
        );
    }

    /**
     * FindFirst that throws an ResourceNotFoundException.
     *
     * @param null $parameters
     * @param string $resource_id
     * @return Model
     * @throws ResourceNotFoundException
     */
    public static function findFirstOrFail($parameters=null, $resource_id='Resource'){
        $result = parent::findFirst($parameters);

        if(empty($result)){
            throw new ResourceNotFoundException($resource_id . ' Not Found');
        } else {
            return $result;
        }
    }
}