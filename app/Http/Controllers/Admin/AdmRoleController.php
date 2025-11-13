<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\AdmCreateRoleRequest;
use App\Http\Requests\Admin\Role\AdmUpdateRoleRequest;
use App\Models\Role;
use App\Services\AdmServices\AdmRoleService;
use Illuminate\Http\Request;

class AdmRoleController extends Controller
{

    public function __construct(readonly protected AdmRoleService $admRoleService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->admRoleService->index();
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
    public function store(AdmCreateRoleRequest $request)
    {
        return $this->admRoleService->create($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->admRoleService->show($id);
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
    public function update(AdmUpdateRoleRequest $request, int $id)
    {
        return $this->admRoleService->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->admRoleService->delete($id);
    }
}
