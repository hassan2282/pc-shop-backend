<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use Illuminate\Http\Request;

class AdmOrderController extends Controller
{

    public function __construct(readonly protected OrderService $service)
    {
    }

    public function index()
    {
        return $this->service->allWithRelations();
    }

    public function show(int $id)
    {
        return $this->service->showWithRels($id);
    }

    public function destroy(int $id)
    {
        return $this->service->deleteOrderWithRels($id);
    }
}
