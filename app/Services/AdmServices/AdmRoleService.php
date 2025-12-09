<?php

namespace App\Services\AdmServices;
use App\Http\Requests\Admin\Role\StoreRoleRequest;
use App\Http\Requests\Admin\Role\UpdateRoleRequest;
use App\Models\Role;
use App\Repositories\AdmRepo\Role\AdmRoleRepositoryInterface;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

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
    
    public function deleteWithRelations($id)
    {
        try{
            $role = Role::findOrFail($id);
            $permsRM =  $role->permissions()->detach();
            $roleRM =  $role->delete();
            if($role && $roleRM && $permsRM){
                return response()->json('نقش با موفقیت حذف شد', HttpResponse::HTTP_OK);
            }
        }catch(\Exception $e){

            if($e->getCode() == '23503'){
                return response()->json('این نقش در حال استفاده توسط کاربران است و قابل حذف نیست', HttpResponse::HTTP_CONFLICT);
            }
            return response()->json($e->getMessage(), HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function updateٌWithRelation(int $id, Request $request)
    {
        try{
            $role = Role::findOrFail($id);
            $role->update([$request->name]);
            $role->save();
            $permsUP =  $role->permissions()->sync($request->permissions);
            if($role && $permsUP){
                return response()->json('نقش با موفقیت ویرایش شد', HttpResponse::HTTP_OK);
            }
        }catch(\Exception $e){
            return response()->json($e->getMessage(), HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
}
