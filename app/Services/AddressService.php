<?php

namespace App\Services;

use App\Http\Requests\AddressRequest;
use App\Http\Resources\AddressResource;
use App\Repositories\Address\AddressRepositoryInterface;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class AddressService
{
    public function __construct(readonly protected AddressRepositoryInterface $addressRepository)
    {
    }

    public function create(AddressRequest $request)
    {
        try {
            $attributes = $request->only(['province_id', 'city_id', 'user_id', 'postal_code', 'address']);
            $create = $this->addressRepository->create($attributes);
            if($create) return response()->json('آدرس با موفقیت افزوده شد', HttpResponse::HTTP_CREATED);
        }catch (\Exception $e) {
            return response()->json($e->getMessage(), HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function find(int $id)
    {
        if(!! auth()->user() === false) return response()->json('کاربر یافت نشد', HttpResponse::HTTP_UNAUTHORIZED);
        if(!! auth()->user() && auth()->user()->id !== $id) return  response()->json('آیدی کاربر با آیدی ارسال شده تطابق ندارد', HttpResponse::HTTP_BAD_REQUEST);

        $address = $this->addressRepository->where('user_id', $id)->first();
        $limitAddress = AddressResource::make($address);

        return response()->json($limitAddress, HttpResponse::HTTP_OK);
    }

    public function delete(int $id)
    {
        if(auth()->user()->address->id === $id) {
            return $this->addressRepository->delete($id);
        }else {
         return response()->json('آیدی وارد شده معتبر نیست');
        }
    }
}
