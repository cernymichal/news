<?php

class CommentRepository extends BaseRepository
{
    public function getComment($id)
    {
        $sql = "
            select *
            from comment
            where id = :id
        ";
        $params = [
            ":id" => $id
        ];

        return $this->db->selectSingle($sql, $params);
    }

    public function getCommentsArticle($article_id)
    {
        $sql = "
            select *
            from comment
            where article_id = :article_id
        ";
        $params = [
            ":article_id" => $article_id
        ];

        return $this->db->select($sql, $params);
    }

    public function addComment($article_id, $name, $email, $text)
    {
        $sql = "
            insert into comment
            set
                article_id = :article_id,
                name = :name,
                email = :email,
                text = :text
        ";
        $params = [
            "article_id" => $article_id,
            "name" => $name,
            "email" => $email,
            "text" => $text
        ];

        return $this->db->insert($sql, $params);
    }

    public function deleteComment($id)
    {
        $sql = "
            delete
            from comment
            where id = :id
        ";
        $params = [
            ":id" => $id
        ];

        return $this->db->delete($sql, $params);
    }
}
