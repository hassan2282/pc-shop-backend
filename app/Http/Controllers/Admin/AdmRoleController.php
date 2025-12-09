<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\UpdateRoleRequest;
use App\Services\AdmServices\AdmRoleService;
use Illuminate\Http\Request;

class AdmRoleController extends Controller
{

    public function __construct(readonly protected AdmRoleService $service)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->service->allWithRelation(['permissions']);
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
    public function store(Request $request)
    {
        return $this->service->storeWithPivot($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->service->show($id);
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
    public function update(int $id)
    {
        return $this->service->update($id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->service->deleteWithRelations($id);
    }
}
