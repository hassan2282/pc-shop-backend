<?php

namespace App\Services\AdmServices;

use App\Http\Requests\Admin\Attribute\StoreAttributeRequest;
use App\Http\Requests\Admin\Attribute\UpdateAttributeRequest;
use App\Repositories\AdmRepo\Attribute\AdmAttributeRepositoryInterface;

class AdmAttributeService extends BaseService
{
    public function __construct(AdmAttributeRepositoryInterface $repository)
    {
        parent::__construct($repository, StoreAttributeRequest::class, UpdateAttributeRequest::class);
    }
}
