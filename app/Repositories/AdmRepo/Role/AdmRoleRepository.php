<?php

namespace App\Repositories\AdmRepo\Role;

use App\Models\Role;
use App\Repositories\BaseRepository;

class AdmRoleRepository extends BaseRepository implements AdmRoleRepositoryInterface
{
    public function __construct(Role $role)
    {
        parent::__construct($role);
    }
}
