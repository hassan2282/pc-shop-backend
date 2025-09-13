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
     * Display the specified resource.
     */
    public function show(Media $media)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Media $media)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Media $media)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Media $media)
    {
        //
    }
}
