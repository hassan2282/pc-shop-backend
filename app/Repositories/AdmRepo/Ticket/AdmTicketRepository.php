<?php

namespace App\Repositories\AdmRepo\Ticket;

use App\Models\Ticket;
use App\Repositories\BaseRepository;

class AdmTicketRepository extends BaseRepository implements AdmTicketRepositoryInterface
{
    public function __construct(Ticket $model)
    {
        parent::__construct($model);
    }
}
