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

    public function find(int $id)
    {
        return Media::find($id);
    }

    public function delete(int $id)
    {
        $targetMedia = $this->find($id);
        $deleteRes =  $targetMedia->delete();
        return response()->json($deleteRes);
    }
}
