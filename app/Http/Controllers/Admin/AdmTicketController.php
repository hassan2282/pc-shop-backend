<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ticket;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ticket\StoreTicketRequest;
use App\Http\Requests\Admin\Ticket\UpdateTicketRequest;
use App\Services\AdmServices\AdmTicketService;

class AdmTicketController extends Controller
{
    public function __construct(readonly protected AdmTicketService $service)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->service->index();
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
    public function store(StoreTicketRequest $request)
    {
        return $this->service->storeAndReturnTicket($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->service->delete($id);
    }
}
