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

    public function allWithRels()
    {
        $data = Category::with([
            'parent:id,name',
            'children:id,name,parent_id',
            'children.children:id,name,parent_id',
            'children.children.children:id,name,parent_id'
        ])
            ->get();
        return $data;
    }
}
