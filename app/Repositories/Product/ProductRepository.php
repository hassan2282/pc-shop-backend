<?php

namespace App\Repositories\Product;

use App\Models\Product;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class ProductRepository implements ProductRepositoryInterface
{

    public function productsForHome()
    {
        return Product::with([
            'media' => fn($query) => $query->limit(1),
            'category:id,name',
            'attribute_values.attribute'
        ])
        ->orderBy('id','DESC')
        ->get() ;
    }


    public function singleProduct(int $id)
    {
        $product = Product::with([
            'media:id,name,mediable_id,mediable_type',
            'attribute_values.attribute',
        ])
        ->find($id);
        return response()->json($product, HttpResponse::HTTP_ACCEPTED);
    }


}
