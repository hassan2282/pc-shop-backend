<?php

namespace App\Repositories\AdmRepo\Article;

use App\Models\Article;
use App\Repositories\BaseRepository;

class AdmArticleRepository extends BaseRepository implements AdmArticleRepositoryInterface
{
    public function __construct(Article $article)
    {
        parent::__construct($article);
    }



    public function articlesWithRelation()
    {
        return Article::query()
        ->select(['id','title','views','status','author_id','category_id'])
        ->with([
            'media:id,name,mediable_id,mediable_type',
            'category:id,name',
            'user:id,first_name,last_name',
        ])
        ->latest()
        ->get();
    }




    public function showWithRelation(int $id)
    {
        return Article::select(['id','description','text','title','category_id'])
        ->with([
            'media:id,name,mediable_id,mediable_type',
            'tags:id,name'
        ])
        ->find($id);
    }


}
