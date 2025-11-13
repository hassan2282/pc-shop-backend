<?php

namespace App\Services\AdmServices;
use App\Http\Requests\Admin\Role\AdmCreateRoleRequest;
use App\Http\Requests\Admin\Role\AdmUpdateRoleRequest;
use App\Repositories\AdmRepo\Role\AdmRoleRepositoryInterface;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class AdmRoleService
{
    public function __construct(readonly protected AdmRoleRepositoryInterface $admRoleRepository)
    {
    }

    public function index()
    {
        $all =  $this->admRoleRepository->all();
        return response()->json(['all' => $all], HttpResponse::HTTP_OK);
    }

    public function create(AdmCreateRoleRequest $request)
    {
        $create = $this->admRoleRepository->create($request->toArray());
        if(!!$create){
            return response()->json('نقش با موفقیت افزوده شد ♥', HttpResponse::HTTP_CREATED);
        }else{
            return response()->json('متاسفانه خطایی رخ داده است !', HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(string $id)
    {
        $find=  $this->admRoleRepository->find($id);
        if ($find){
            return response()->json(['find' => $find], HttpResponse::HTTP_OK);
        }else{
            return response()->json(['نقش پیدا نشد!'], HttpResponse::HTTP_BAD_REQUEST);
        }
    }

    public function update(AdmUpdateRoleRequest $request, int $id)
    {
        $find =  $this->admRoleRepository->find($id);
        if ($find){
            try {
                $this->admRoleRepository->update($id, $request->toArray());
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
        $find =  $this->admRoleRepository->find($id);
        if ($find){
            $delete = $this->admRoleRepository->delete($id);
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
