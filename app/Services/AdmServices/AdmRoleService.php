<?php

namespace App\Services\AdmServices;
use App\Http\Requests\Admin\Role\StoreRoleRequest;
use App\Http\Requests\Admin\Role\UpdateRoleRequest;
use App\Models\Role;
use App\Repositories\AdmRepo\Role\AdmRoleRepositoryInterface;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AdmRoleService extends BaseService
{

    public function __construct(AdmRoleRepositoryInterface $repository)
    {
        parent::__construct($repository, StoreRoleRequest::class, UpdateRoleRequest::class);
    }


    public function storeWithPivot(Request $request) {
        try{

            $role =  Role::create([
                'name' => $request->name, 
            ]);
            $attach = $role->permissions()->attach($request->permissions);

            if($role && $attach){
                return response()->json('با موفقیت ساخته شد');
            }

        }catch(\Exception $e){
            return response()->json($e->getMessage());
        }
    }
    
}
