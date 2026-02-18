<?php

namespace App\Services;

use App\Models\Article;
use App\Repositories\Article\ArticleRepositoryInterface;

class ArticleService
{
    public function __construct(readonly protected ArticleRepositoryInterface $repository,) {}


    public function blogShow()
    {
        return $this->repository->blogShow();
    }

    public function singleBlog(int $id)
    {
        return $this->repository->singleBlog($id);
    }
}
