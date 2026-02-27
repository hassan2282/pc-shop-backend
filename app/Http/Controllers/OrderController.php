<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Requests\UpdateOrderUserInfoRequest;
use App\Services\OrderService;

class OrderController extends Controller
{

    public function __construct(readonly protected OrderService $service) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function userInfo(UpdateOrderUserInfoRequest $request)
    {
        $user = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
        ];

        $id = $request->id;

        $address = [
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'postal_code' => $request->postal_code,
            'address' => $request->address,
            'user_id' => $id,
        ];
        return $this->service->userInfo($user, $address, $id);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
