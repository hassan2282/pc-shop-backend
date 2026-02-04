<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AdmServices\AdmConversationService;

class AdmConversationController extends Controller
{
    public function __construct(readonly protected AdmConversationService $service)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->service->allWithLastTicket();
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
    public function store()
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->service->findWithRelation($id, ['user','tickets']);
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
     //   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
