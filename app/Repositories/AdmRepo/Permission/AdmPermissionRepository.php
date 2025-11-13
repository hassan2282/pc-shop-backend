<?php

namespace App\Repositories\AdmRepo\Permission;

use App\Models\Permission;
use App\Repositories\BaseRepository;

class AdmPermissionRepository extends BaseRepository implements AdmPermissionRepositoryInterface
{
    public function __construct(Permission $permission)
    {
        parent::__construct($permission);
    }
}
