<?php

namespace App\Http\Controllers;

use App\Http\Resources\cityResource;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function find(int $id)
    {
        $targetProvince = cityResource::collection(City::where('province_id', $id)->get());
         if(count($targetProvince) === 0) return response()->json('متاسفانه شهری یافت نشد');
        return response()->json($targetProvince);
    }
}
