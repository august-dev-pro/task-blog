<?php

namespace August\Entitys;

class ArticleEntity
{
    private $id;
    private $title;
    private $description;
    private $content;
    private $publish_date;
    private $author_id;
    private $categorie_id;
    private $commentariesNumber;
    private $published;
    private $updatedDate;
    private $files;

    /**
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     */
    public function setTitle($title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     */
    public function setDescription($description): self
    {
        $this->description = $description;

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
     * Get the value of categorie_id
     */
    public function getCategorieId()
    {
        return $this->categorie_id;
    }

    /**
     * Set the value of categorie_id
     */
    public function setCategorieId($categorie_id): self
    {
        $this->categorie_id = $categorie_id;

        return $this;
    }

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
     * Get the value of commentariesNumber
     */
    public function getCommentariesNumber()
    {
        return $this->commentariesNumber;
    }

    /**
     * Set the value of commentariesNumber
     */
    public function setCommentariesNumber($commentariesNumber): self
    {
        $this->commentariesNumber = $commentariesNumber;

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
     * Get the value of published
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Set the value of published
     */
    public function setPublished($published): self
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get the value of updatedDate
     */
    public function getUpdatedDate()
    {
        return $this->updatedDate;
    }

    /**
     * Set the value of updatedDate
     */
    public function setUpdatedDate($updatedDate): self
    {
        $this->updatedDate = $updatedDate;

        return $this;
    }

    /**
     * Get the value of files
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * Set the value of files
     */
    public function setFiles($files): self
    {
        $this->files = $files;

        return $this;
    }
}
