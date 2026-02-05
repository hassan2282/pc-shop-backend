<?php

namespace App\Services\AdmServices;

use App\Http\Requests\Admin\Ticket\StoreTicketRequest;
use App\Http\Requests\Admin\Ticket\UpdateTicketRequest;
use App\Repositories\AdmRepo\Ticket\AdmTicketRepositoryInterface;


class AdmTicketService extends BaseService
{
    public function __construct(AdmTicketRepositoryInterface $repository)
    {
        parent::__construct($repository, StoreTicketRequest::class, UpdateTicketRequest::class);
    }

    public function storeAndReturnTicket(StoreTicketRequest $request)
    {
        $data =  $this->repository->create($request->toArray());
        return response()->json($data);
    }

}