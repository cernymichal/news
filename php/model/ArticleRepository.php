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

    public function addArticle($user_id, $title, $perex, $text)
    {
        $sql = "
            insert into article
            set
                user_id = :user_id,
                title = :title,
                perex = :perex,
                text = :text
        ";
        $params = [
            ":user_id" => $user_id,
            ":title" => $title,
            ":perex" => $perex,
            ":text" => $text
        ];

        return $this->db->insert($sql, $params);
    }

    public function editArticle($id, $user_id, $title, $perex, $text)
    {
        $sql = "
            update article
            set
                user_id = :user_id,
                title = :title,
                perex = :perex,
                text = :text
            where id = :id
        ";
        $params = [
            ":id" => $id,
            ":user_id" => $user_id,
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
