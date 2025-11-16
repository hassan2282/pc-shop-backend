<?php

namespace App\Services\AdmServices;

use App\Http\Requests\Admin\Article\StoreArticleRequest;
use App\Http\Requests\Admin\Article\UpdateArticleRequest;
use App\Repositories\AdmRepo\Article\AdmArticleRepositoryInterface;

class AdmArticleService extends BaseService
{
    public function __construct(AdmArticleRepositoryInterface $repository)
    {
        parent::__construct($repository, StoreArticleRequest::class, UpdateArticleRequest::class);
    }
}
