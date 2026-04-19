<?php

namespace App\Repositories\Order;

use App\Repositories\EloquentRepositoryInterface;

interface OrderRepositoryInterface extends EloquentRepositoryInterface
{
    public function allOrdersWithRelations();
    public function showWithRels(int $id);
    public function lastOrder();
}
