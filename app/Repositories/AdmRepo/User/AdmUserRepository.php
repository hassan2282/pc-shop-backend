<?php

namespace App\Repositories\AdmRepo\User;

use App\Models\User;
use App\Repositories\BaseRepository;

class AdmUserRepository extends BaseRepository implements AdmUserRepositoryInterface
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }
}
