<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Services\MediaService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MediaController extends Controller
{

    public function __construct(readonly protected MediaService $mediaService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }


    public function store(Request $request):JsonResponse
    {
        return $this->mediaService->create($request);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Media $media)
    {
        //
    }
}
