<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute_value;
use App\Http\Requests\Admin\Attribute_value\StoreAttribute_valueRequest;
use App\Http\Requests\Admin\Attribute_value\UpdateAttribute_valueRequest;
use App\Services\AdmServices\AdmAttribute_valueService;

class AttributeValueController extends Controller
{
    public function __construct(readonly protected AdmAttribute_valueService $service) {

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreAttribute_valueRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Attribute_value $attribute_value)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attribute_value $attribute_value)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAttribute_valueRequest $request, Attribute_value $attribute_value)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attribute_value $attribute_value)
    {
        //
    }
}
