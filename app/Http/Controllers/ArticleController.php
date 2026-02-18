<?php

namespace App\Http\Controllers;

use App\Services\ArticleService;

class ArticleController extends Controller
{

    public function __construct(readonly protected ArticleService $service) {}

    public function blogShow()
    {
        return $this->service->blogShow();
    }

    public function singleBlog(int $id)
    {
        return $this->service->singleBlog($id);
    }
}
