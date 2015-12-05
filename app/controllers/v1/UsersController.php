<?php

namespace v1;

use Phalcon\Mvc\Model\Query;

class UsersController extends \ControllerBase
{

    public function index()
    {
        $phql = "SELECT * FROM User";
        $users = $this->modelsManager->executeQuery($phql);

        $data = array();
        foreach ($users as $user) {
            $data[] = array(
                'id'   => $user->id,
                'email' => $user->email
            );
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

