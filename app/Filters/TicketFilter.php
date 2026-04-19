<?php

namespace App\Filters;

use App\Models\Article;

class TicketFilter
{
    protected $count;
    protected $queryParams;
    protected $result;
    protected $perPage;
    protected $searchKey;
    protected $role;
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
    private function extractRole(): void
    {
        $this->role = $this->extractKeyByKeyName('role');
    }

    private function createQuery(): void
    {
        if ($this->searchKey) {
            $this->query->whereHas('tickets', function ($query) {
                $query->where('text', 'LIKE', '%' . $this->searchKey . '%');
            });
        }

        if (isset($this->role)) {
            if ($this->role === '1') {
                // نمایش مکالماتی که آخرین تیکت آن‌ها admin_id برابر با null دارند
                $this->query->whereHas('tickets', function ($query) {
                    $query->orderBy('id', 'DESC')->where('admin_id', null);
                });
            } else {
                // نمایش مکالماتی که آخرین تیکت آن‌ها admin_id نابرابر با null است
                $this->query->whereHas('tickets', function ($query) {
                    $query->orderBy('id', 'DESC')->where('admin_id', '<>', null);
                });
            }
        }
    }

    private function fetchData()
    {
        $this->count = $this->query->count();
        $this->result = $this->query->with(['tickets' => function ($query) {
            $query->orderBy('created_at', 'DESC')->limit(1)->get();
        }])->orderBy('id', 'DESC')->paginate($this->perPage);
    }

    private function filter(): void
    {
        $this->extractSearchKey();
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
