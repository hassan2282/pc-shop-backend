<?php

namespace App\Repositories\Product;

use App\Repositories\EloquentRepositoryInterface;

interface ProductRepositoryInterface extends EloquentRepositoryInterface
{
    public function productsForHome();
    public function singleProduct(int $id);
}
