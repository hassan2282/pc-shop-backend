<?php

namespace App\Repositories\AdmRepo\Article;

use App\Repositories\EloquentRepositoryInterface;

interface AdmArticleRepositoryInterface extends EloquentRepositoryInterface
{
     public function articlesWithRelation();
     public function showWithRelation(int $id);
}
