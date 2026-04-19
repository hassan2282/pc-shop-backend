<?php

namespace App\Repositories\Article;

use App\Models\Article;

interface ArticleRepositoryInterface
{
    public function allWithRelations(array $relations);
    public function blogShow();
    public function singleBlog(int $id);
}
