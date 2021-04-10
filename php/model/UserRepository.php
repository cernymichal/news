<?php

class UserRepository extends BaseRepository
{
    public function getUsers()
    {
        $sql = "select * from user";

        return $this->db->select($sql);
    }

    public function getUsersAlphabetically()
    {
        $sql = "select * from user order by name";

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

    public function getUserEmail($email)
    {
        $sql = "
            select *
            from user
            where email = :email
        ";
        $params = [
            ":email" => $email
        ];

        return $this->db->selectSingle($sql, $params);
    }

    public function addUser($email, $password, $name, $admin)
    {
        $sql = "
            insert into user
            set
                email = :email,
                password = :password,
                name = :name,
                admin = :admin
        ";
        $params = [
            ":email" => $email,
            ":password" => password_hash($password, PASSWORD_DEFAULT),
            ":name" => $name,
            ":admin" => $admin
        ];

        return $this->db->insert($sql, $params);
    }

    public function editUser($id, $email, $password, $name, $admin)
    {
        $sql = "
            update user
            set
                email = :email,
                " . (empty($password) ? "" : "password = :password,") . "
                name = :name,
                admin = :admin
            where id = :id
        ";
        $params = [
            ":id" => $id,
            ":email" => $email,
            ":name" => $name,
            ":admin" => $admin
        ];

        if (!empty($password)) {
            $params["password"] = password_hash($password, PASSWORD_DEFAULT);
        }

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
