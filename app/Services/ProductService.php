<?php

namespace App\Services;

use App\Repositories\Product\ProductRepositoryInterface;

class ProductService
{
    public function __construct(readonly protected ProductRepositoryInterface $repository,) {

    }


    public function productsForHome()
    {
        return $this->repository->productsForHome();
    }
    
    
    
    public function singleProduct(int $id)
    {
        return $this->repository->singleProduct($id);
    }
}
