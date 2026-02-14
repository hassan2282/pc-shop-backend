<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\StoreProductRequest;
use App\Http\Requests\Admin\Product\UpdateProductRequest;
use App\Models\Product;
use App\Services\AdmServices\AdmProductService;

class AdmProductController extends Controller
{

    public function __construct(readonly protected AdmProductService $service)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->service->productWithRels();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        return $this->service->storeProduct($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return $this->service->showWithRelations($product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Product $product, UpdateProductRequest $request)
    {
        return $this->service->updateProduct($product, $request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        return $this->service->deleteWithRelations($product);
    }
}
