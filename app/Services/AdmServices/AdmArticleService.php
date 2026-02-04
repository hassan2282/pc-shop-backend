<?php

namespace App\Services\AdmServices;

use App\Http\Requests\Admin\Article\StoreArticleRequest;
use App\Http\Requests\Admin\Article\UpdateArticleRequest;
use App\Models\Article;
use App\Repositories\AdmRepo\Article\AdmArticleRepositoryInterface;
use App\Services\ImageOptimizerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class AdmArticleService extends BaseService
{
    public function __construct(AdmArticleRepositoryInterface $repository)
    {
        parent::__construct($repository, StoreArticleRequest::class, UpdateArticleRequest::class);
    }

    public function editor(Request $request)
    {
        $image = $request->file('media');
        $image_name = time() . '-' . Str::random(20) . '.' . $image->getClientOriginalExtension();
        $path = $image->storeAs('articleEditor', $image_name, 'public');
        try {
            $absolutePath = Storage::disk('public')->path($path);
            ImageOptimizerService::optimize($absolutePath);
        } catch (\Exception $exception) {

            Storage::disk('public')->delete($path);
            return response()->json(
                'خطا در بهینه سازی تصویر - لطفاً تصویر با کیفیت پایینتر آپلود کنید',
                HttpResponse::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        // $media = [
        //     'name' => $image_name,
        //     'mimeType' => $image->getMimeType(),
        //     'size' => $image->getsize(),
        //     'mediable_type' => Article::class,
        //     'mediable_id' => $user->id,
        // ];

        // $res =  $this->mediaRepository->create($media);
        // if ($res) {
        //     return response()->json(['Media Created Successfully', 'path' => $image_name], HttpResponse::HTTP_CREATED);
        // } else {
        //     return response()->json('متاسفانه خطایی از سمت سرور رخ داده است', HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        // }
    }
}
