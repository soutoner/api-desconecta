<?php

namespace v1;

use Phalcon\Mvc\Model\Query;

class UsersController extends \ControllerBase
{

    public function index()
    {
        $users = $this->modelsManager->createBuilder()
            ->from('User')
            ->getQuery()
            ->execute()->toArray();

        $data = array();
        foreach ($users as $user) {
            $data[] = [
                'id'                => $user->id,
                'name'              => $user->name,
                'surname'           => $user->surname,
                'email'             => $user->email,
                'profile_picture'   => $user->profile_picture,
                'date_birth'        => $user->date_birth,
                'gender'            => $user->gender,
                'from'              => $user->from,
            ];
        }



        echo json_encode($data);
    }

    public function create()
    {
        $request = $this->request;

        $phql = "INSERT INTO User (name, surname, email, profile_picture)
          VALUES (:name:, :surname:, :email:, :profile_picture:)";

        $status = $this->modelsManager->executeQuery($phql, array(
            'name'            => $request->get("name", "string"),
            'surname'         => $request->get("surname", "string"),
            'email'           => $request->get("email", "email"),
            'profile_picture' => $request->get("profile_picture", "string"),
        ));

        return $this->response($request, $status);
    }

    public function delete($id)
    {
        $phql = "DELETE FROM User WHERE id = :id:";

        $status = $this->modelsManager->executeQuery($phql, array(
            'id' => $id
        ));

        return $this->response($this->request ,$status);
    }

}

