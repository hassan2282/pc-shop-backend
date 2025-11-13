<?php

namespace App\Services\AdmServices;
use App\Http\Requests\Admin\Role\AdmCreateRoleRequest;
use App\Http\Requests\Admin\Role\AdmUpdateRoleRequest;
use App\Repositories\AdmRepo\Role\RoleRepositoryInterface;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class AdmRoleService
{
    public function __construct(readonly protected RoleRepositoryInterface $roleRepository)
    {
    }

    public function index()
    {
        $all =  $this->roleRepository->all();
        return response()->json(['all' => $all], HttpResponse::HTTP_OK);
    }

    public function create(AdmCreateRoleRequest $request)
    {
        $create = $this->roleRepository->create($request->toArray());
        if(!!$create){
            return response()->json('نقش با موفقیت افزوده شد ♥', HttpResponse::HTTP_CREATED);
        }else{
            return response()->json('متاسفانه خطایی رخ داده است !', HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(string $id)
    {
        $find=  $this->roleRepository->find($id);
        if ($find){
            return response()->json(['find' => $find], HttpResponse::HTTP_OK);
        }else{
            return response()->json(['نقش پیدا نشد!'], HttpResponse::HTTP_BAD_REQUEST);
        }
    }

    public function update(AdmUpdateRoleRequest $request, int $id)
    {
        $find =  $this->roleRepository->find($id);
        if ($find){
            try {
                $this->roleRepository->update($id, $request->toArray());
                return response()->json(['نقش با موفقیت آپدیت شد ♥'], HttpResponse::HTTP_OK);
            }catch(\Exception $e){
                return response()->json(['error' => $e->getMessage()], HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
            }
        }else{
            return response()->json(['نقش پیدا نشد!'], HttpResponse::HTTP_BAD_REQUEST);
        }

    }

    public function delete(string $id)
    {
        $find =  $this->roleRepository->find($id);
        if ($find){
            $delete = $this->roleRepository->delete($id);
            if($delete){
                return response()->json(['نقش با موفقیت حذف شد ♥'], HttpResponse::HTTP_OK);
            }else{
                return response()->json(['متاسفانه خطایی در فراید حذف نقش رخ داده است'], HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
            }
        }else{
            return response()->json(['نقش پیدا نشد!'], HttpResponse::HTTP_BAD_REQUEST);
        }

    }
}
