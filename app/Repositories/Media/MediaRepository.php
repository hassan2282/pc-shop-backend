<?php

namespace App\Repositories\Media;

use App\Models\Media;
use Illuminate\Http\JsonResponse;

class MediaRepository implements MediaRepositoryInterface
{
    public function create(array $media):JsonResponse
    {
        $res = Media::create($media);
        return response()->json($res);
    }
}
