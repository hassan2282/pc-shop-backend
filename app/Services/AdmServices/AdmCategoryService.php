<?php

namespace App\Services\AdmServices;

use App\Http\Requests\Admin\Category\StoreCategoryRequest;
use App\Http\Requests\Admin\Category\UpdateCategoryRequest;
use App\Repositories\AdmRepo\Category\AdmCategoryRepositoryInterface;

class AdmCategoryService extends BaseService
{
    public function __construct(AdmCategoryRepositoryInterface $repository)
    {
        parent::__construct($repository, StoreCategoryRequest::class, UpdateCategoryRequest::class);
    }
}
