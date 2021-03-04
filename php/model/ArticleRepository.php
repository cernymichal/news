<?php

class ArticleRepository extends BaseRepository
{
    public function getArticles()
    {
        $sql = "select * from article";

        return $this->db->select($sql);
    }

    public function getArticlesUser($id)
    {
        $sql = "select * from article";

        return $this->db->select($sql);
    }

    public function getArticlesCategory($id)
    {
        $sql = "select * from article";

        return $this->db->select($sql);
    }

    public function getArticle($id)
    {
        $sql = "
            select *
            from article
            where id = :id
        ";
        $params = [
            ":id" => $id
        ];

        return $this->db->selectSingle($sql, $params);
    }

    public function addArticle($title, $perex, $text)
    {
        $sql = "
            insert into article
            set
                title = :title,
                perex = :perex,
                text = :text,
                created_at = now()
        ";
        $params = [
            ":title" => $title,
            ":perex" => $perex,
            ":text" => $text
        ];

        return $this->db->insert($sql, $params);
    }

    public function editArticle($id, $title, $perex, $text)
    {
        $sql = "
            update article
            set
                title = :title,
                perex = :perex,
                text = :text
            where id = :id
        ";
        $params = [
            ":id" => $id,
            ":title" => $title,
            ":perex" => $perex,
            ":text" => $text
        ];

        return $this->db->update($sql, $params);
    }

    public function deleteArticle($id)
    {
        $sql = "
            delete
            from article
            where id = :id
        ";
        $params = [
            ":id" => $id
        ];

        return $this->db->delete($sql, $params);
    }
}
