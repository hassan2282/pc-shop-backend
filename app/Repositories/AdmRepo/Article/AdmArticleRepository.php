<?php

namespace App\Repositories\AdmRepo\Article;

use App\Models\Article;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class AdmArticleRepository extends BaseRepository implements AdmArticleRepositoryInterface
{
    public function __construct(Article $article)
    {
        parent::__construct($article);
    }
}
