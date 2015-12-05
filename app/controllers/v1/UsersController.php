<?php

namespace v1;


use Phalcon\Http\Response;

class UsersController extends \ControllerBase
{

    public function indexAction()
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

    public function createAction()
    {
        $user = $this->request->getJsonRawBody();

        $phql = "INSERT INTO User (name, surname, email, profile_picture)
          VALUES (:name:, :surname:, :email:, :profile_picture:)";

        $status = $this->modelsManager->executeQuery($phql, array(
            'name'            => $user->name,
            'surname'         => $user->surname,
            'email'           => $user->email,
            'profile_picture' => $user->profile_picture
        ));

        // Create a response
        $response = new Response();

        // Check if the insertion was successful
        if ($status->success() == true) {

            // Change the HTTP status
            $response->setStatusCode(201, "Created");

            $user->id = $status->getModel()->id;

            $response->setJsonContent(
                array(
                    'status' => 'OK',
                    'data'   => $user
                )
            );

        } else {

            // Change the HTTP status
            $response->setStatusCode(409, "Conflict");

            // Send errors to the client
            $errors = array();
            foreach ($status->getMessages() as $message) {
                $errors[] = $message->getMessage();
            }

            $response->setJsonContent(
                array(
                    'status'   => 'ERROR',
                    'messages' => $errors
                )
            );
        }

        return $response;
    }

}

