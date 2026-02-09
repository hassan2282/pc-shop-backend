<?php

namespace App\Repositories\AdmRepo\Gate;

use App\Models\Gate;
use App\Repositories\BaseRepository;

class AdmGateRepository extends BaseRepository implements AdmGateRepositoryInterface
{
    public function __construct(Gate $gate)
    {
        parent::__construct($gate);
    }
}
