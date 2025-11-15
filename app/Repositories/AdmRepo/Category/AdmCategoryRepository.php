<?php

namespace App\Repositories\AdmRepo\Category;

use App\Models\Category;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class AdmCategoryRepository extends BaseRepository implements AdmCategoryRepositoryInterface
{
    public function __construct(Category $category)
    {
        parent::__construct($category);
    }
}
