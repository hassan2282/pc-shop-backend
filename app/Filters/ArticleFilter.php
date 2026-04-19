<?php

namespace App\Filters;

class ArticleFilter
{
    protected $queryParams;
    protected $result;
    protected $count;
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
    private function extractSearchKey()
    {
        $this->searchKey = $this->extractKeyByKeyName('q');
    }

    private function extractStatus(): void
    {
        $this->status = $this->extractKeyByKeyName('status');
    }

    private function createQuery(): void
    {
        if ($this->searchKey) $this->query->where('title', 'LIKE', '%' . $this->searchKey . '%')
            ->orWhereHas('user', function ($query) {
            $query->Where('first_name','LIKE','%'.$this->searchKey.'%')
            ->orWhere('last_name','LIKE','%'.$this->searchKey.'%');
        });
        if (isset($this->status)) $this->query->where('status', $this->status);
    }

    private function fetchData()
    {
        $this->count = $this->query->count();
        $this->result = $this->query->with(['category:id,name','user:id,first_name,last_name','media:mediable_id,mediable_type,name'])
        ->paginate($this->perPage);
    }

    private function filter(): void
    {
        $this->extractSearchKey();
        $this->extractStatus();
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
