<?php

namespace App\Repositories\AdmRepo\Attribute_value;

use App\Models\Attribute_value;
use App\Repositories\BaseRepository;

class AdmAttribute_valueRepository extends BaseRepository implements AdmAttribute_valueRepositoryInterface
{
    public function __construct(Attribute_value $attribute_value)
    {
        parent::__construct($attribute_value);
    }
}
