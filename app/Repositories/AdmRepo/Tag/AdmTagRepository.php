<?php

namespace App\Repositories\AdmRepo\Tag;

use App\Models\Tag;
use App\Repositories\BaseRepository;

class AdmTagRepository extends BaseRepository implements AdmTagRepositoryInterface
{
    public function __construct(Tag $model)
    {
        parent::__construct($model);
    }
}
