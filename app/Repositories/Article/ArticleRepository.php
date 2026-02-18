<?php

namespace App\Repositories\Article;

use App\Models\Article;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class ArticleRepository implements ArticleRepositoryInterface
{

    public function blogShow()
    {
        $data = Article::select(['id', 'author_id', 'description', 'created_at'])
            ->with([
                'media:id,name,mediable_id,mediable_type',
                'user:id,username'
            ])
            ->limit(6)
            ->get();

        return response()->json($data, HttpResponse::HTTP_ACCEPTED);
    }


    public function singleBlog(int $id)
    {
        $article = Article::with([
            'media:id,name,mediable_id,mediable_type',
            'user:id,username',
            'category:id,name',
        ])
        ->find($id);

        $blogWithRels = Article::select(['id','category_id','description'])
        ->with([
            'category:id,name',
        ])
        ->limit(7)
        ->get();

        return response()->json([$article, $blogWithRels], HttpResponse::HTTP_ACCEPTED);
    }
}
