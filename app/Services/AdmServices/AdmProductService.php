<?php

namespace App\Services\AdmServices;

use App\Http\Requests\Admin\Product\StoreProductRequest;
use App\Http\Requests\Admin\Product\UpdateProductRequest;
use App\Repositories\AdmRepo\Product\AdmProductRepositoryInterface;

class AdmProductService extends BaseService
{
    public function __construct(AdmProductRepositoryInterface $repository)
    {
        parent::__construct($repository, StoreProductRequest::class, UpdateProductRequest::class);
    }
}
