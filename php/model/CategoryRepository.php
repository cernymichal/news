<?php

class CategoryRepository extends BaseRepository
{
    public function getCategories()
    {
        $sql = "select * from category";

        return $this->db->select($sql);
    }

    public function getCategoriesArticle($article_id)
    {
        $sql = "
            select
                category.*
            from category
                inner join article_category on article_category.category_id = category.id
            where article_category.article_id = :article_id
        ";
        $params = [
            ":article_id" => $article_id
        ];
        $categories = $this->db->select($sql, $params);

        return $categories;
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
