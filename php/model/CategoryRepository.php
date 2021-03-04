<?php

class CategoryRepository extends BaseRepository
{
    public function getCategories()
    {
        $sql = "select * from category";

        return $this->db->select($sql);
    }

    public function getCategory($id)
    {
        $sql = "
            select *
            from category
            where id = :id
        ";
        $params = [
            ":id" => $id
        ];

        return $this->db->selectSingle($sql, $params);
    }

    public function addCategory($name)
    {
        $sql = "
            insert into category
            set
                name = :name
        ";
        $params = [
            ":name" => $name
        ];

        return $this->db->insert($sql, $params);
    }

    public function editCategory($id, $name)
    {
        $sql = "
            update category
            set
                name = :name
            where id = :id
        ";
        $params = [
            ":id" => $id,
            ":name" => $name
        ];

        return $this->db->update($sql, $params);
    }

    public function deleteCategory($id)
    {
        $sql = "
            delete
            from category
            where id = :id
        ";
        $params = [
            ":id" => $id
        ];

        return $this->db->delete($sql, $params);
    }
}
