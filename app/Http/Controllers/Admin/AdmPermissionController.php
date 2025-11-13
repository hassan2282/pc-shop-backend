<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Permission\StorePermissionRequest;
use App\Http\Requests\Admin\Permission\UpdatePermissionRequest;
use App\Services\AdmServices\AdmPermissionService;

class AdmPermissionController extends Controller
{
    public function __construct(readonly protected AdmPermissionService $admPermissionService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->admPermissionService->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePermissionRequest $request)
    {
        return $this->admPermissionService->create($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->admPermissionService->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePermissionRequest $request, int $id)
    {
        return $this->admPermissionService->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->admPermissionService->delete($id);
    }
}
