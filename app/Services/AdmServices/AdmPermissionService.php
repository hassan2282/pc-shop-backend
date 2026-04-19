<?php

namespace App\Services\AdmServices;

use App\Filters\BaseFilter;
use App\Http\Requests\Admin\Permission\StorePermissionRequest;
use App\Http\Requests\Admin\Permission\UpdatePermissionRequest;
use App\Repositories\AdmRepo\Permission\AdmPermissionRepositoryInterface;

class AdmPermissionService extends BaseService
{
    public function __construct(
        AdmPermissionRepositoryInterface $repository,
    ) {
        parent::__construct($repository, StorePermissionRequest::class, UpdatePermissionRequest::class);
    }


    // public function allWithFilters()
    // {
    //     // $filter = $this->base_filter->getByFilters($queryParams,5,$columns,null,$query);
    //     return response()->json($filter);
    // }
}
