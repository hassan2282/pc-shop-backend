<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Media\MediaRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class MediaService
{

    public function __construct(readonly protected MediaRepositoryInterface $mediaRepository)
    {
    }

    public function create(Request $request)
    {
        $image = $request->media;
        $image_name = time() . '-' . Str::random(20) . '.' . $image->getClientOriginalExtension();
        $user = auth()->user();
        if(!$user) return response()->json('متاسفانه کاربر یافت نشد');

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
                        return response()->json('Media Created Successfully', HttpResponse::HTTP_CREATED);
                    }else {
                        return response()->json('متاسفانه خطایی از سمت سرور رخ داده است');
                    }
        }

    }
}
