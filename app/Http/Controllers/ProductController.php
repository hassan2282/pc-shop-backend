<?php

namespace App\Http\Controllers;

use App\Services\ProductService;

class ProductController extends Controller
{

public function __construct(readonly protected ProductService $service)
{
}

    public function productsForHome()
    {
        return $this->service->productsForHome();
    }


    public function singleProduct(int $id)
    {
        return $this->service->singleProduct($id);
    }
}
