<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdmCreateUserRequest;
use App\Http\Requests\Admin\AdmUpdateUserRequest;
use App\Services\AdmServices\User\AdmUserService;
use Illuminate\Http\Request;

class AdmUserController extends Controller
{

    public function __construct(readonly protected AdmUserService $admUserService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->admUserService->index();
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
    public function store(AdmCreateUserRequest $request)
    {
        return $this->admUserService->create($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->admUserService->show($id);
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
    public function update(AdmUpdateUserRequest $request, int $id)
    {
        return $this->admUserService->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->admUserService->delete($id);
    }
}
