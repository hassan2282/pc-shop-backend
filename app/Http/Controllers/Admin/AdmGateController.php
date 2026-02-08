<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Gate\StoreGateRequest;
use App\Services\AdmServices\AdmGateService;

class AdmGateController extends Controller
{
    public function __construct(readonly protected AdmGateService $service)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->service->index();
    }

    public function gateGuard(StoreGateRequest $request)
    {
        return $this->service->gateGuard($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGateRequest $request)
    {
        return $this->service->storeKey($request);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        return $this->service->delete($id);
    }
}
