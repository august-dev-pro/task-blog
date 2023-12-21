<?php

namespace August\Entitys;

class CommentaryEntity
{
    private $id;
    private $content;
    private $publish_date;
    private $author_id;
    private $article_id;

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of content
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     */
    public function setContent($content): self
    {
        $this->content = $content;

        return $this;
    }
    /**
     * Get the value of publish_date
     */
    public function getPublishDate()
    {
        return $this->publish_date;
    }
    /**
     * Set the value of publish_date
     */
    public function setPublishDate($publish_date): self
    {
        $this->publish_date = $publish_date;

        return $this;
    }

    /**
     * Get the value of author_id
     */
    public function getAuthorId()
    {
        return $this->author_id;
    }

    /**
     * Set the value of author_id
     */
    public function setAuthorId($author_id): self
    {
        $this->author_id = $author_id;

        return $this;
    }

    /**
     * Get the value of article_id
     */
    public function getArticleId()
    {
        return $this->article_id;
    }

    /**
     * Set the value of article_id
     */
    public function setArticleId($article_id): self
    {
        $this->article_id = $article_id;

        return $this;
    }
}
