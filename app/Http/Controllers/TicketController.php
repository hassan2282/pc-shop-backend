<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserTicketStoreRequest;
use App\Services\TicketService;

class TicketController extends Controller
{

    public function __construct(readonly protected TicketService $service) {}


    public function show(int $id)
    {
        return $this->service->show($id);
    }


    public function store(UserTicketStoreRequest $request)
    {
        return $this->service->store($request->toArray());
    }


    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}
