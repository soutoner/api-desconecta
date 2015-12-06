<?php

namespace v1;


class UsersController extends \ControllerBase
{

    public function index()
    {
        $users = $this->modelsManager->createBuilder()
            ->from('User')
            ->getQuery()
            ->execute();

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
                'location'          => $user->location,
            ];
        }

        echo json_encode($data);
    }

    public function create()
    {
        // TODO: Create custom filters
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

    public function update($id){
        $request = $this->request;

        $user = $this->modelsManager->createBuilder()
            ->from('User')
            ->where('id = :id:', ['id' => $id])
            ->getQuery()
            ->execute()
            ->getFirst();

        $phql = "UPDATE User SET
          name = :name:, surname = :surname:, email = :email:, profile_picture = :profile_picture:,
          date_birth = :date_birth:, gender = :gender:, location = :location:
          WHERE id = :id:";
        $status = $this->modelsManager->executeQuery($phql, [
            'id'                => $id,
            'name'              => $request->getPost('name', 'string', $user->name),
            'surname'           => $request->getPost('surname', 'string', $user->surname),
            'email'             => $request->getPost('email', 'email', $user->email),
            'profile_picture'   => $request->getPost('profile_picture', 'string', $user->profile_picture),
            'date_birth'        => $request->getPost('date_birth', 'string', $user->date_birth),
            'gender'            => $request->getPost('gender', 'string', $user->gender),
            'location'          => $request->getPost('location', 'string', $user->location),
        ]);

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

