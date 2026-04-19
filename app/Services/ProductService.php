<?php

namespace App\Services;

use App\Filters\CategoryProductFilter;
use App\Repositories\Product\ProductRepositoryInterface;

class ProductService
{
    public function __construct(readonly protected ProductRepositoryInterface $repository) {}

    public function productsWithFilters()
    {
        $queryParams = [
            'category' => request()->category,
            'sortFilter' => request()->sortFilter,
            'minRange' => request()->minRange,
            'maxRange' => request()->maxRange,
        ];
        try {
            $query = $this->repository->query();
            $filter = (new CategoryProductFilter($queryParams, 6, $query))->getResult();
            return response()->json($filter);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
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
