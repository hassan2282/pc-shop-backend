<?php

namespace App\Filters;


class CategoryFilter
{
    protected $count;
    protected $queryParams;
    protected $result;
    protected $perPage;
    protected $searchKey;
    protected \Illuminate\Database\Eloquent\Builder $query;

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
    private function extractSearchKey()
    {
        $this->searchKey = $this->extractKeyByKeyName('q');
    }

    private function createQuery(): void
    {
        if ($this->searchKey) $this->query->where('name', 'LIKE', '%' . $this->searchKey . '%');
    }

    private function fetchData()
    {
        $this->count = $this->query->count();
        $this->result = $this->query->with(['parent:id,name', 'children:id,name,parent_id'])->orderBy('id', 'DESC')->paginate($this->perPage);
    }

    private function filter(): void
    {
        $this->extractSearchKey();
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
