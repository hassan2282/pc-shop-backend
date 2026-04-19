<?php

namespace App\Filters;

use App\Models\Article;

class UserFilter
{
    protected $count;
    protected $queryParams;
    protected $result;
    protected $perPage;
    protected $searchKey;
    protected \Illuminate\Database\Eloquent\Builder $query;
    protected $status;
    protected $role;

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
    private function extractRole(): void
    {
        $this->role = $this->extractKeyByKeyName('role');
    }

    private function createQuery(): void
    {
        if ($this->searchKey) $this->query->where('first_name', 'LIKE', '%' . $this->searchKey . '%')
            ->orWhere('last_name', 'LIKE', '%' . $this->searchKey . '%');
        if (isset($this->status)) $this->query->orWhere('status', $this->status);
        if (isset($this->role)) {
            $this->role === '1' ?
                $this->query->orWhere('role_id', 1) :
                $this->query->orWhere('role_id','!=', 1);
        }
        // if (isset($this->role)) $this->query->whereHas('user', function ($query) {
        //     $query->orWhere('role_id', $this->role );
        // });
    }

    private function fetchData()
    {
        $this->count = $this->query->count();
        $this->result = $this->query->with(['role', 'media'])->paginate($this->perPage);
    }

    private function filter(): void
    {
        $this->extractSearchKey();
        $this->extractStatus();
        $this->extractRole();
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
