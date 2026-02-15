<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Media\MediaRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class MediaService
{

    public function __construct(readonly protected MediaRepositoryInterface $mediaRepository)
    {
    }

    public function create(Request $request)
    {

        $image = $request->file('media');
        if (!$image) {
            return response()->json('هیچ فایلی ارسال نشده', HttpResponse::HTTP_BAD_REQUEST);
        }

        $user = auth()->user();
        if(!$user) return response()->json('متاسفانه کاربر یافت نشد');

        if($user->media?->first()){
            $storageDelete =  Storage::disk('public')->delete('/media/'. $user->media->first()->name);
            !$storageDelete && throw new \Exception('متاسفانه فایل پروفایل قبلی از دیتابیس حذف نشد!!!');
            $deleteRes =  $this->mediaRepository->delete($user->media->first()->id);
            !$deleteRes && throw new \Exception('متاسفانه اطلاعات پروفایل قبلی از دیتابیس حذف نشد!!!');
        }


        $image_name = time() . '-' . Str::random(20) . '.' . $image->getClientOriginalExtension();
        $path = $image->storeAs('media', $image_name, 'public');

        try {
            $absolutePath = Storage::disk('public')->path($path);
            ImageOptimizerService::optimize($absolutePath);
        }catch (\Exception $exception){

            Storage::disk('public')->delete($path);
            return response()->json(
                'خطا در بهینه سازی تصویر - لطفاً تصویر با کیفیت پایینتر آپلود کنید',
                HttpResponse::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        if($user) {
                    $media = [
                        'name' => $image_name,
                        'mimeType' => $image->getMimeType(),
                        'size' => $image->getsize(),
                        'mediable_type' => User::class,
                        'mediable_id' => $user->id,
                    ];

                    $res =  $this->mediaRepository->create($media);
                    if ($res) {
                        return response()->json(['Media Created Successfully' , 'path' => $image_name], HttpResponse::HTTP_CREATED);
                    }else {
                        return response()->json('متاسفانه خطایی از سمت سرور رخ داده است',HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
                    }
        }

    }
}
