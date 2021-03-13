<?php

class ArticleRepository extends BaseRepository
{
    public function getArticles()
    {
        $sql = "
            select
                article.*,
                user.name as user_name
            from article
                left join user on article.user_id = user.id
        ";

        $articles = $this->db->select($sql);

        return $this->addCategories($articles);
    }

    public function getArticlesLast5()
    {
        $sql = "
            select
                article.*,
                user.name as user_name
            from article
                left join user on article.user_id = user.id
            where published = 1
            order by created_at desc
            limit 5
        ";

        $articles = $this->db->select($sql);

        return $this->addCategories($articles);
    }

    public function getArticlesAlphabetically()
    {
        $sql = "
            select
                article.*,
                user.name as user_name
            from article
                left join user on article.user_id = user.id
            order by title
        ";

        $articles = $this->db->select($sql);

        return $this->addCategories($articles);
    }

    public function getArticlesUser($user_id)
    {
        $sql = "
            select
                article.*,
                user.name as user_name
            from article
                left join user on article.user_id = user.id
            where article.user_id = :user_id
        ";
        $params = [
            ":user_id" => $user_id
        ];

        $articles = $this->db->select($sql, $params);

        return $this->addCategories($articles);
    }

    public function getArticlesCategory($category_id)
    {
        $sql = "
            select 
                article.*,
                user.name as user_name
            from article
                left join user on article.user_id = user.id
                inner join article_category on article_category.article_id = article.id
            where article_category.category_id = :category_id
        ";
        $params = [
            ":category_id" => $category_id
        ];

        $articles = $this->db->select($sql, $params);

        return $this->addCategories($articles);
    }

    public function getArticle($id)
    {
        $sql = "
            select
                article.*,
                user.name as user_name
            from article
                left join user on article.user_id = user.id
            where article.id = :id
        ";
        $params = [
            ":id" => $id
        ];

        $article = $this->db->selectSingle($sql, $params);

        return $this->addCategoriesSingle($article);
    }

    public function addArticle($user_id, $title, $perex, $text, $published, $categories)
    {
        $sql = "
            insert into article
            set
                user_id = :user_id,
                title = :title,
                perex = :perex,
                text = :text,
                published = :published
        ";
        $params = [
            ":user_id" => $user_id,
            ":title" => $title,
            ":perex" => $perex,
            ":text" => $text,
            ":published" => $published
        ];

        $result = $this->db->insert($sql, $params);

        $this->updateCategories($this->db->lastInsertId(), $categories);

        return $result;
    }

    public function editArticle($id, $user_id, $title, $perex, $text, $published, $categories)
    {
        $sql = "
            update article
            set
                user_id = :user_id,
                title = :title,
                perex = :perex,
                text = :text,
                published = :published
            where id = :id
        ";
        $params = [
            ":id" => $id,
            ":user_id" => $user_id,
            ":title" => $title,
            ":perex" => $perex,
            ":text" => $text,
            ":published" => $published
        ];

        $result = $this->db->update($sql, $params);

        $this->updateCategories($id, $categories);

        return $result;
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

    private function addCategories($articles)
    {
        $cr = new CategoryRepository($this->db);

        foreach ($articles as $key => $article) {
            $articles[$key]["categories"] = $cr->getCategoriesArticle($article["id"]);
        }

        return $articles;
    }

    private function addCategoriesSingle($article)
    {
        $cr = new CategoryRepository($this->db);

        $article["categories"] = $cr->getCategoriesArticle($article["id"]);

        return $article;
    }

    private function updateCategories($article_id, $categories)
    {
        $cr = new CategoryRepository($this->db);

        $current_categories = array_column($cr->getCategoriesArticle($article_id), "id");

        foreach ($categories as $category_id) {
            if (!in_array($category_id, $current_categories)) {
                $sql = "
                    insert into article_category
                    set
                        article_id = :article_id,
                        category_id = :category_id
                ";
                $params = [
                    ":article_id" => $article_id,
                    ":category_id" => $category_id
                ];

                $this->db->insert($sql, $params);
            }
        }

        foreach ($current_categories as $category_id) {
            if (!in_array($category_id, $categories)) {
                $sql = "
                    delete from article_category
                    where article_id = :article_id and category_id = :category_id
                ";
                $params = [
                    ":article_id" => $article_id,
                    ":category_id" => $category_id
                ];

                $this->db->delete($sql, $params);
            }
        }
    }
}
