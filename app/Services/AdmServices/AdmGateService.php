<?php

namespace App\Services\AdmServices;

use App\Http\Requests\Admin\Gate\StoreGateRequest;
use App\Http\Requests\Admin\Gate\UpdateGateRequest;
use App\Repositories\AdmRepo\Gate\AdmGateRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class AdmGateService extends BaseService
{
    public function __construct(AdmGateRepositoryInterface $repository)
    {
        parent::__construct($repository, StoreGateRequest::class, UpdateGateRequest::class);
    }

    public function storeKey(StoreGateRequest $request)
    {
        $data = ['gkey' => bcrypt($request->gkey)];
        return $this->repository->create($data);
    }

    public function gateGuard(StoreGateRequest $request)
    {
        try{
            $realKey = $this->repository->all()->first();
            $result = Hash::check($request->gkey, $realKey->gkey);
            if($result === true){
                return response()->json(true, 200);
            }else{
                return response()->json(false, 200);
            }
        }catch(\Exception $e){
            return response()->json(['message' => $e->getMessage()], 500);
        };
    }

}