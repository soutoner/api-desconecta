<?php


namespace App\Models;

use Phalcon\Mvc\Model;
use App\Exceptions\ResourceNotFoundException;

class BaseModel extends Model
{
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