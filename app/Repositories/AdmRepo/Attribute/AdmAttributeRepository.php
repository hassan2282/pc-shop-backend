<?php

namespace App\Repositories\AdmRepo\Attribute;

use App\Models\Attribute;
use App\Repositories\BaseRepository;

class AdmAttributeRepository extends BaseRepository implements AdmAttributeRepositoryInterface
{
    public function __construct(Attribute $attribute)
    {
        parent::__construct($attribute);
    }
}
