<?php

namespace August\Services;

use August\Repositorys\CommentaryRepository;


class CommentaryService
{
    private $commentaryRepository;
    public function __construct()
    {
        $this->commentaryRepository = new CommentaryRepository();
    }

    public function addCommentary($commentary)
    {
        $resultat = $this->commentaryRepository->addCommentary($commentary);
        return $resultat;
    }

    public function getCommentariesForArticle($article_id)
    {
        $resultat = $this->commentaryRepository->getCommentariesForArticle($article_id);
        return $resultat;
    }

    public function deleteCommentariesForArticle($article_id)
    {
        $resultat = $this->commentaryRepository->deleteCommentariesForArticle($article_id);
        return $resultat;
    }

    public function deleteCommentary($commentaryId)
    {
        $resultat = $this->commentaryRepository->deleteCommentary($commentaryId);
        return $resultat;
    }
}
