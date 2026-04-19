<?php

namespace App\Filters;

class TransactionFilter
{
    protected $queryParams;
    protected $result;
    protected $count;
    protected $category;
    protected $sortFilter;
    protected $minRange;
    protected $maxRange;
    protected $perPage;
    protected $searchKey;
    protected \Illuminate\Database\Eloquent\Builder $query;
    protected $status;

    public function __construct($queryParams, $perPage, $query)
    {
        $this->queryParams = $queryParams;
        $this->perPage = $perPage;
        $this->query = $query;
        $this->filter();
    }

    /**
     * @param $key
     * @return mixed|void
     */
    private function extractKeyByKeyName($key)
    {
        if (isset($this->queryParams[$key])) {
            $q = $this->queryParams[$key];
            unset($this->queryParams[$q]);
            return $q;
        }
    }
    
    private function extractCategory()
    {
        $this->category = $this->extractKeyByKeyName('category');
    }
    private function extractSortFilter()
    {
        $this->sortFilter = $this->extractKeyByKeyName('sortFilter');
    }
    private function extractMaxRange()
    {
        $this->maxRange = $this->extractKeyByKeyName('maxRange');
    }
    private function extractMinRange()
    {
        $this->minRange = $this->extractKeyByKeyName('minRange');
    }

    

    private function createQuery(): void
    {
        if ($this->category) $this->query->whereHas('category', function ($query) {
            $query->where('parent_id', $this->category);
        });
        if (isset($this->sortFilter)){
            if($this->sortFilter === 'newest') $this->query->orderBy('id','DESC');
            if($this->sortFilter === 'maxPrice') $this->query->orderBy('price','DESC');
            if($this->sortFilter === 'minPrice') $this->query->orderBy('price','ASC');
            if($this->sortFilter === 'mostVisited') $this->query->orderBy('views','DESC');
            if($this->sortFilter === 'inventoryExist') $this->query->where('amount','>', 0);
        }

        if (isset($this->minRange)) $this->query->where('price', '>', $this->minRange);
        if (isset($this->maxRange)) $this->query->where('price', '<', $this->maxRange);

    }

    private function fetchData()
    {
        $this->count = $this->query->count();
        $this->result = $this->query->select([
            'id','category_id','price','amount','title','status','views'
        ])->with([
            'media' => fn($query) => $query->limit(1),
            'category:id,name',
        ])->orderBy('id', 'DESC')->paginate($this->perPage);
    }

    private function filter(): void
    {
        $this->extractCategory();
        $this->extractSortFilter();
        $this->extractMinRange();
        $this->extractMaxRange();
        $this->createQuery();
        $this->fetchData();
    }

    public function getResult(): mixed
    {
        $data = [
            $this->count / $this->perPage,
            $this->result,
        ];
        return $data;
    }
}
