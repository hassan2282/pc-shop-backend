<?php

namespace App\Services;

use App\Filters\TransactionFilter;
use App\Repositories\Transaction\TransactionRepositoryInterface;

class ProductService
{
    public function __construct(readonly protected TransactionRepositoryInterface $repository) {}

    // public function transactionWithFilters()
    // {
    //     $queryParams = [
    //         'category' => request()->category,
    //         'sortFilter' => request()->sortFilter,
    //         'minRange' => request()->minRange,
    //         'maxRange' => request()->maxRange,
    //     ];
    //     try {
    //         $query = $this->repository->query();
    //         $filter = (new TransactionFilter($queryParams, 6, $query))->getResult();
    //         return response()->json($filter);
    //     } catch (\Exception $e) {
    //         return response()->json($e->getMessage());
    //     }
    // }





    // public function singleProduct(int $id)
    // {
    //     return $this->repository->singleProduct($id);
    // }
}
