<?php

namespace v1;


class UsersController extends \ControllerBase
{
    /**
     * Returns all the users in the database.
     *
     * TODO: Pagination
     */
    public function index()
    {
        $phql = "SELECT * FROM User";
        $users = $this->modelsManager->executeQuery($phql);

        $data = [];
        foreach ($users as $user) {
            $data[] = [
                'id'                => $user->id,
                'name'              => $user->name,
                'surname'           => $user->surname,
                'email'             => $user->email,
                'profile_picture'   => $user->profile_picture,
                'date_birth'        => $user->date_birth,
                'gender'            => $user->gender,
                'location'          => $user->location,
            ];
        }

        echo json_encode($data);
    }

    /**
     * Creates an user in the database.
     *
     * TODO: Create custom filters (e.g. filter for dates)
     *
     * @return \Phalcon\Http\Response
     */
    public function create()
    {
        $request = $this->request;

        $phql = "INSERT INTO User (name, surname, email, profile_picture, date_birth, gender, location)
          VALUES (:name:, :surname:, :email:, :profile_picture:, :date_birth:, :gender:, :location:)";
        $status = $this->modelsManager->executeQuery($phql, [
            'name'              => $request->get("name", "string"),
            'surname'           => $request->get("surname", "string"),
            'email'             => $request->get("email", "email"),
            'profile_picture'   => $request->get("profile_picture", "string"),
            'date_birth'        => $request->get("date_birth", "string"),
            'gender'            => $request->get("gender", "string"),
            'location'          => $request->get("location", "string"),
        ]);

        return $this->response($request, $status);
    }

    /**
     * Updates an user. Always use `x-www-form-urlencoded` content type for PUT.
     *
     * @param $id - Id of the user to be deleted
     * @return \Phalcon\Http\Response
     */
    public function update($id){
        $request = $this->request;

        $phql = "SELECT * FROM User WHERE id = :id:";
        $user = $this->modelsManager->executeQuery($phql, [
            'id' => $id,
        ])->getFirst();

        $phql = "UPDATE User SET
          name = :name:, surname = :surname:, email = :email:, profile_picture = :profile_picture:,
          date_birth = :date_birth:, gender = :gender:, location = :location:
          WHERE id = :id:";
        $status = $this->modelsManager->executeQuery($phql, [
            'id'                => $id,
            'name'              => $request->getPut('name', 'string', $user->name),
            'surname'           => $request->getPut('surname', 'string', $user->surname),
            'email'             => $request->getPut('email', 'email', $user->email),
            'profile_picture'   => $request->getPut('profile_picture', 'string', $user->profile_picture),
            'date_birth'        => $request->getPut('date_birth', 'string', $user->date_birth),
            'gender'            => $request->getPut('gender', 'string', $user->gender),
            'location'          => $request->getPut('location', 'string', $user->location),
        ]);

        return $this->response($request, $status);
    }

    /**
     * Deletes an user from the database.
     *
     * @param $id - Id of the user to be deleted
     * @return \Phalcon\Http\Response
     */
    public function delete($id)
    {
        $phql = "DELETE FROM User WHERE id = :id:";
        $status = $this->modelsManager->executeQuery($phql, array(
            'id' => $id
        ));

        return $this->response($this->request ,$status);
    }

}

