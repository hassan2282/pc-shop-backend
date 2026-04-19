<?php

namespace App\Services\AdmServices;

use App\Filters\CategoryFilter;
use App\Http\Requests\Admin\Category\StoreCategoryRequest;
use App\Http\Requests\Admin\Category\UpdateCategoryRequest;
use App\Repositories\AdmRepo\Category\AdmCategoryRepositoryInterface;

class AdmCategoryService extends BaseService
{
    public function __construct(AdmCategoryRepositoryInterface $repository)
    {
        parent::__construct($repository, StoreCategoryRequest::class, UpdateCategoryRequest::class);
    }

    public function allWithRels()
    {
        return $this->repository->allWithRels();
    }

    public function allWithFilter()
    {
        $queryParams = [
            'q' => request()->q,
        ];
        $query = $this->repository->query();
        $filter = (new CategoryFilter($queryParams, 5, $query))->getResult();
        return response()->json($filter);
    }
}
