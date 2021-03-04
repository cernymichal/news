<?php

class UserRepository extends BaseRepository
{
    public function getUsers()
    {
        $sql = "select * from user";

        return $this->db->select($sql);
    }

    public function getUser($id)
    {
        $sql = "
            select *
            from user
            where id = :id
        ";
        $params = [
            ":id" => $id
        ];

        return $this->db->selectSingle($sql, $params);
    }

    public function addUser($email, $password, $name, $surname)
    {
        $sql = "
            insert into user
            set
                email = :email,
                password = :password,
                name = :name,
                surname = :surname
        ";
        $params = [
            ":email" => $email,
            ":password" => $password,
            ":name" => $name,
            ":surname" => $surname
        ];

        return $this->db->insert($sql, $params);
    }

    public function editUser($id, $email, $password, $name, $surname)
    {
        $sql = "
            update user
            set
                email = :email,
                password = :password,
                name = :name,
                surname = :surname
            where id = :id
        ";
        $params = [
            ":id" => $id,
            ":email" => $email,
            ":password" => $password,
            ":name" => $name,
            ":surname" => $surname
        ];

        return $this->db->update($sql, $params);
    }

    public function deleteUser($id)
    {
        $sql = "
            delete
            from user
            where id = :id
        ";
        $params = [
            ":id" => $id
        ];

        return $this->db->delete($sql, $params);
    }
}
