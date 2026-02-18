<?php

namespace App\Repositories\Product;

interface ProductRepositoryInterface
{
    public function productsForHome();
    public function singleProduct(int $id);
}
