<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Services\AddressService;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function __construct(readonly protected AddressService $addressService)
    {
    }

    public function create(AddressRequest $request)
    {
        return $this->addressService->create($request);
    }

    public function find(int $id)
    {
        return $this->addressService->find($id);
    }

    public function delete(int $id)
    {
        return $this->addressService->delete($id);
    }

}
