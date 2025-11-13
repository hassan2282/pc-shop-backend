<?php

namespace App\Services\AdmServices\User;

use App\Http\Requests\Admin\AdmCreateUserRequest;
use App\Http\Requests\Admin\AdmUpdateUserRequest;
use App\Repositories\AdmRepo\User\AdmUserRepositoryInterface;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class AdmUserService
{
    public function __construct(readonly protected AdmUserRepositoryInterface $admUserRepository)
    {
    }

    public function index()
    {
        $users =  $this->admUserRepository->all();
        return response()->json(['users' => $users], HttpResponse::HTTP_OK);
    }

    public function create(AdmCreateUserRequest $request)
    {
        $create = $this->admUserRepository->create($request->toArray());
        if(!!$create){
            return response()->json('کاربر با موفقیت افزوده شد ♥', HttpResponse::HTTP_CREATED);
        }else{
            return response()->json('متاسفانه خطایی رخ داده است !', HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(string $id)
    {
        $user =  $this->admUserRepository->find($id);
        if ($user){
            return response()->json(['user' => $user], HttpResponse::HTTP_OK);
        }else{
            return response()->json(['کاربر پیدا نشد!'], HttpResponse::HTTP_BAD_REQUEST);
        }
    }

    public function update(AdmUpdateUserRequest $request, int $id)
    {
        $user =  $this->admUserRepository->find($id);
        if ($user){
            try {
                $this->admUserRepository->update($id, $request->toArray());
                return response()->json(['کاربر با موفقیت آپدیت شد ♥'], HttpResponse::HTTP_OK);
            }catch(\Exception $e){
                return response()->json(['error' => $e->getMessage()], HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
            }
        }else{
            return response()->json(['کاربر پیدا نشد!'], HttpResponse::HTTP_BAD_REQUEST);
        }

    }

    public function delete(string $id)
    {
        $user =  $this->admUserRepository->find($id);
        if ($user){
            $delete = $this->admUserRepository->delete($id);
            if($delete){
                return response()->json(['کاربر با موفقیت حذف شد ♥'], HttpResponse::HTTP_OK);
            }else{
                return response()->json(['متاسفانه خطایی در فراید حذف کاربر رخ داده است'], HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
            }
        }else{
            return response()->json(['کاربر پیدا نشد!'], HttpResponse::HTTP_BAD_REQUEST);
        }

    }

}
