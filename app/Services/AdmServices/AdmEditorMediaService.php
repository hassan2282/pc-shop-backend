<?php

namespace App\Services\AdmServices;

use App\Http\Requests\Admin\EditorMedia\StoreEditorMediaRequest;
use App\Http\Requests\Admin\EditorMedia\UpdateEditorMediaRequest;
use App\Repositories\AdmRepo\EditorMedia\AdmEditorMediaRepositoryInterface;
use App\Services\ImageOptimizerService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class AdmEditorMediaService extends BaseService
{
    public function __construct(AdmEditorMediaRepositoryInterface $repository, readonly protected AdmEditorMediaRepositoryInterface $admEditorMediaRepository)
    {
        parent::__construct($repository, StoreEditorMediaRequest::class, UpdateEditorMediaRequest::class);
    }

    public function media(StoreEditorMediaRequest $request)
    {
        $image = $request->file('media');
        $url = time() . '-' . Str::random(20) . '.' . $image->getClientOriginalExtension();
        $path = $image->storeAs('articleEditor', $url, 'public');

        try {
            // مسیر واقعی فایل
            $absolutePath = Storage::disk('public')->path($path);

            // بهینه‌سازی تصویر
            ImageOptimizerService::optimize($absolutePath);

            // ذخیره در دیتابیس
            $media = [
                'name' => $url,
                'mimeType' => $image->getMimeType(),
                'size' => $image->getSize(),
            ];

            $res = $this->admEditorMediaRepository->create($media);

            return response()->json([
                'id' => $res->id,
                'name' => $url,
                'url' => asset('storage/articleEditor/' . $url),
            ], HttpResponse::HTTP_CREATED);
        } catch (\Exception $exception) {

            // 🔥 حذف فایل در صورت هرگونه خطا
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }

            return response()->json([
                'message' => 'خطا در آپلود یا بهینه‌سازی تصویر',
                'error' => $exception->getMessage(),
            ], HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }




    public function deleteMedia(int $id)
    {
        $media = $this->admEditorMediaRepository->find($id);

        if (!$media) {
            return response()->json([
                'message' => 'فایل مورد نظر یافت نشد'
            ], HttpResponse::HTTP_NOT_FOUND);
        }

        // مسیر فایل
        $path = 'articleEditor/' . $media->name;

        try {
            // حذف فایل فیزیکی
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }

            // حذف رکورد دیتابیس
            $this->admEditorMediaRepository->delete($id);

            return response()->json([
                'message' => 'فایل با موفقیت حذف شد'
            ], HttpResponse::HTTP_OK);
        } catch (\Throwable $e) {

            return response()->json([
                'message' => 'خطا در حذف فایل',
                'error' => $e->getMessage()
            ], HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
