<?php

namespace App\Repositories\AdmRepo\Product;

use App\Models\Product;
use App\Repositories\BaseRepository;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class AdmProductRepository extends BaseRepository implements AdmProductRepositoryInterface
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }
    
    public function productWithRelations()
    {
    }



    public function showProduct(Product $product)
    {
        
         $data = $product->load([
                'media',
                'tags:id,name',
                'attribute_values.attribute',
            ]);
        

        return response()->json($data, HttpResponse::HTTP_OK);
    }

}
