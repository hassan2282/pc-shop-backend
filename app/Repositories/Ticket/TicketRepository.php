<?php

namespace App\Repositories\Ticket;

use App\Models\Ticket;
use App\Repositories\BaseRepository;

class TicketRepository extends BaseRepository implements TicketRepositoryInterface
{
    public function __construct(Ticket $ticket)
    {
        parent::__construct($ticket);
    }
}
