<?php

namespace App\Http\Controllers;

use App\Http\Resources\provinceResource;
use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    public function index()
    {
        $provinces = provinceResource::collection(Province::all());
        return response()->json($provinces);
    }
}
