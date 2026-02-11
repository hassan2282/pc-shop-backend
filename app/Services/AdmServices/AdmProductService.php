<?php

namespace App\Services\AdmServices;

use App\Http\Requests\Admin\Product\StoreProductRequest;
use App\Http\Requests\Admin\Product\UpdateProductRequest;
use App\Models\Product;
use App\Repositories\AdmRepo\Product\AdmProductRepositoryInterface;
use App\Repositories\AdmRepo\Tag\AdmTagRepositoryInterface;
use App\Repositories\Media\MediaRepositoryInterface;
use App\Services\ImageOptimizerService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class AdmProductService extends BaseService
{
    public function __construct(
        AdmProductRepositoryInterface $repository,
        readonly protected MediaRepositoryInterface $mediaRepository,
        readonly protected AdmTagRepositoryInterface $tagRepository
    ) {
        parent::__construct($repository, StoreProductRequest::class, UpdateProductRequest::class);
    }


    public function storeProduct(StoreProductRequest $request)
    {


        try {

            // Start Product
            $product = [
                'title' => $request->title,
                'price' => $request->price,
                'amount' => $request->amount,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'text' => $request->text,
            ];

            $productRes = $this->repository->create($product);
            // End Product




            // Start Tag
            $tags = $request->tags;
            foreach ($tags as $tag) {
                $find = $this->tagRepository->where('name', $tag)->first();
                if (!$find) {
                    $tagRes = $this->tagRepository->create([
                        'name' => $tag,
                    ]);
                    $productRes->tags()->syncWithoutDetaching($tagRes->id);
                } else {
                    $productRes->tags()->syncWithoutDetaching($find->id);
                }
            }
            // Edn Tag




            foreach ($request->file() as $image) {
                $image_name = time() . '-' . Str::random(20) . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('media', $image_name, 'public');
                $absolutePath = Storage::disk('public')->path($path);
                ImageOptimizerService::optimize($absolutePath);
                $media = [
                    'name' => $image_name,
                    'mimeType' => $image->getMimeType(),
                    'size' => $image->getSize(),
                    'mediable_type' => Product::class,
                    'mediable_id' => $productRes->id,
                    'alt' => 'Product Image'
                ];
                $mediaRes = $this->mediaRepository->create($media);
                // End Media    
            }
            //Start Media


            return response()->json('محصول با موفقیت افزوده شد', HttpResponse::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
