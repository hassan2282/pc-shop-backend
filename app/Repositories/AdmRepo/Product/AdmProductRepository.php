<?php

namespace App\Repositories\AdmRepo\Product;

use App\Models\Product;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class AdmProductRepository extends BaseRepository implements AdmProductRepositoryInterface
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }
}
