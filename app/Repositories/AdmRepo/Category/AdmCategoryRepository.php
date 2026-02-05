<?php

namespace App\Repositories\AdmRepo\Category;

use App\Models\Category;
use App\Repositories\BaseRepository;

class AdmCategoryRepository extends BaseRepository implements AdmCategoryRepositoryInterface
{
    public function __construct(Category $category)
    {
        parent::__construct($category);
    }
}
