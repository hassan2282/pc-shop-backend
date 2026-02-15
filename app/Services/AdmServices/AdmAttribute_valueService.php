<?php

namespace App\Services\AdmServices;

use App\Http\Requests\Admin\Attribute_value\StoreAttribute_valueRequest;
use App\Http\Requests\Admin\Attribute_value\UpdateAttribute_valueRequest;
use App\Repositories\AdmRepo\Attribute_value\AdmAttribute_valueRepositoryInterface;

class AdmAttribute_valueService extends BaseService
{
    public function __construct(AdmAttribute_valueRepositoryInterface $repository)
    {
        parent::__construct($repository, StoreAttribute_valueRequest::class, UpdateAttribute_valueRequest::class);
    }
}
