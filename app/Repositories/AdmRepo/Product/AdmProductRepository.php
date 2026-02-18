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
        return $this->model->with([
            'media' => fn($query) => $query->limit(1),
            'category:id,name',
        ])
        ->orderBy('id','DESC')
        ->get() ;
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
