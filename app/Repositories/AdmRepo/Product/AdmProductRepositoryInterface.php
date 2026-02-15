<?php

namespace App\Repositories\AdmRepo\Product;

use App\Models\Product;
use App\Repositories\EloquentRepositoryInterface;

interface AdmProductRepositoryInterface extends EloquentRepositoryInterface
{
    public function productWithRelations();
    public function productsForHome();
    public function showProduct(Product $product);
}
