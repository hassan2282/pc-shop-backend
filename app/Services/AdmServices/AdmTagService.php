<?php

namespace App\Services\AdmServices;

use App\Http\Requests\Admin\Tag\StoreTagRequest;
use App\Http\Requests\Admin\Tag\UpdateTagRequest;
use App\Repositories\AdmRepo\Tag\AdmTagRepositoryInterface;

class AdmTagService extends BaseService
{
    public function __construct(AdmTagRepositoryInterface $repository)
    {
        parent::__construct($repository, StoreTagRequest::class, UpdateTagRequest::class);
    }
}
