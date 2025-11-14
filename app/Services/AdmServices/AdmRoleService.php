<?php

namespace App\Services\AdmServices;
use App\Http\Requests\Admin\Role\StoreRoleRequest;
use App\Http\Requests\Admin\Role\UpdateRoleRequest;
use App\Repositories\AdmRepo\Role\AdmRoleRepositoryInterface;

class AdmRoleService extends BaseService
{
    public function __construct(AdmRoleRepositoryInterface $repository)
    {
        parent::__construct($repository, StoreRoleRequest::class, UpdateRoleRequest::class);
    }
}
