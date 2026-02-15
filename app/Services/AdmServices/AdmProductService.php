<?php

namespace App\Services\AdmServices;

use App\Http\Requests\Admin\Product\StoreProductRequest;
use App\Http\Requests\Admin\Product\UpdateProductRequest;
use App\Models\Product;
use App\Repositories\AdmRepo\Attribute\AdmAttributeRepositoryInterface;
use App\Repositories\AdmRepo\Attribute_value\AdmAttribute_valueRepositoryInterface;
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
        readonly protected AdmTagRepositoryInterface $tagRepository,
        readonly protected AdmAttributeRepositoryInterface $attributeRepository,
        readonly protected AdmAttribute_valueRepositoryInterface $attribute_valueRepository,
    ) {
        parent::__construct($repository, StoreProductRequest::class, UpdateProductRequest::class);
    }


    public function productWithRels()
    {
        return $this->repository->productWithRelations();
    }

    public function productsForHome()
    {
        return $this->repository->productsForHome();
    }



    public function showWithRelations(Product $product)
    {
        return $this->repository->showProduct($product);
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



            //Start Media
            foreach ($request->media as $image) {
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



            // Start Attribute & Attribute_value

            foreach ($request->allAttributes as $item) {
                if ($item['attribute'] && $item['value']) {
                    $targetAttribute = $this->attributeRepository->where('name', $item['attribute'])->first();
                    if (!$targetAttribute) {
                        $attributeRes = $this->attributeRepository->create(['name' => $item['attribute']]);
                        $attribute_valueRes = $this->attribute_valueRepository->create([
                            'attribute_id' => $attributeRes->id,
                            'value' => $item['value'],
                        ]);
                        $productRes->attribute_values()->syncWithoutDetaching($attribute_valueRes->id);
                    } else {
                        $attribute_valueRes = $this->attribute_valueRepository->create([
                            'attribute_id' => $targetAttribute->id,
                            'value' => $item['value'],
                        ]);
                        $productRes->attribute_values()->syncWithoutDetaching($attribute_valueRes->id);
                    }
                }
            }

            // End Attribute & Attribute_value



            return response()->json('محصول با موفقیت افزوده شد', HttpResponse::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }






    public function updateProduct(Product $product, UpdateProductRequest $request)
    {

        try {


            foreach ($product->media as $item) {
                Storage::disk('public')->delete('/media/' . $item->name);
                $item->delete();
            }
            $product->tags()->detach();
            $product->attribute_values()->detach();

            // Start Product
            $updateProduct = [
                'title' => $request->title,
                'price' => $request->price,
                'amount' => $request->amount,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'text' => $request->text,
            ];

            $productRes = $this->repository->update($product->id, $updateProduct);
            // End Product


            // Start Tag
            $tags = $request->tags;
            foreach ($tags as $tag) {
                $find = $this->tagRepository->where('name', $tag)->first();
                if (!$find) {
                    $tagRes = $this->tagRepository->create([
                        'name' => $tag,
                    ]);
                    $product->tags()->syncWithoutDetaching($tagRes->id);
                } else {
                    $product->tags()->syncWithoutDetaching($find->id);
                }
            }
            // Edn Tag



            //Start Media
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
                    'mediable_id' => $product->id,
                    'alt' => 'Product Image'
                ];
                $mediaRes = $this->mediaRepository->create($media);
                // End Media
            }



            // Start Attribute & Attribute_value

            foreach ($request->allAttributes as $item) {
                if ($item['attribute'] && $item['value']) {
                    $targetAttribute = $this->attributeRepository->where('name', $item['attribute'])->first();
                    if (!$targetAttribute) {
                        $attributeRes = $this->attributeRepository->create(['name' => $item['attribute']]);
                        $attribute_valueRes = $this->attribute_valueRepository->create([
                            'attribute_id' => $attributeRes->id,
                            'value' => $item['value'],
                        ]);
                        $product->attribute_values()->syncWithoutDetaching($attribute_valueRes->id);
                    } else {
                        $attribute_valueRes = $this->attribute_valueRepository->create([
                            'attribute_id' => $targetAttribute->id,
                            'value' => $item['value'],
                        ]);
                        $product->attribute_values()->syncWithoutDetaching($attribute_valueRes->id);
                    }
                }
            }

            // End Attribute & Attribute_value



            return response()->json('محصول با موفقیت ویرایش شد', HttpResponse::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }






    public function deleteWithRelations(Product $product)
    {

        try {
            foreach ($product->media as $image) {
                Storage::disk('public')->delete('/media/' . $image->name);
                $image->delete();
            };
            foreach ($product->tags as $tag) {
                $tag->delete();
            }
            $product->delete();
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
