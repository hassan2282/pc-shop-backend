<?php

namespace App\Services\AdmServices;

use App\Http\Requests\Admin\User\StoreAdmUserRequest;
use App\Http\Requests\Admin\User\UpdateAdmUserRequest;
use App\Repositories\AdmRepo\User\AdmUserRepositoryInterface;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class AdmUserService extends BaseService
{
    public function __construct(AdmUserRepositoryInterface $repository)
    {
        parent::__construct($repository, StoreAdmUserRequest::class, UpdateAdmUserRequest::class);
    }

}
