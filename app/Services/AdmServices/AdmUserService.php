<?php

namespace App\Services\AdmServices;

use App\Filters\UserFilter;
use App\Http\Requests\Admin\User\StoreAdmUserRequest;
use App\Http\Requests\Admin\User\UpdateAdmUserRequest;
use App\Models\User;
use App\Repositories\AdmRepo\User\AdmUserRepositoryInterface;

class AdmUserService extends BaseService
{
    public function __construct(AdmUserRepositoryInterface $repository)
    {
        parent::__construct($repository, StoreAdmUserRequest::class, UpdateAdmUserRequest::class);
    }

    public function allWithFilters()
    {
        $queryParams = [
            'q' => request()->q,
            'status' => request()->status,
            'role' => request()->role,
        ];
        try {
            $query = $this->repository->query();
            $filter = (new UserFilter($queryParams, 5, $query))->getResult();
            return response()->json($filter);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
