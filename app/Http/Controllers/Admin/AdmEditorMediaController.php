<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EditorMedia;
use App\Http\Requests\Admin\EditorMedia\StoreEditorMediaRequest;
use App\Http\Requests\Admin\EditorMedia\UpdateEditorMediaRequest;
use App\Services\AdmServices\AdmEditorMediaService;

class AdmEditorMediaController extends Controller
{

    public function __construct(readonly protected AdmEditorMediaService $service)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEditorMediaRequest $request)
    {
        return $this->service->media($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(EditorMedia $editorMedia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EditorMedia $editorMedia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEditorMediaRequest $request, EditorMedia $editorMedia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        return $this->service->deleteMedia($id);
    }
}
