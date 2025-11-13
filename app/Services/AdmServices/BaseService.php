<?php

namespace App\Services\AdmServices;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

abstract class BaseService
{
    protected object $repository;
    protected ?string $storeRequest;
    protected ?string $updateRequest;

    public function __construct(object $repository, ?string $storeRequest = null, ?string $updateRequest = null)
    {
        $this->repository = $repository;
        $this->storeRequest = $storeRequest;
        $this->updateRequest = $updateRequest;
    }

    public function index(): JsonResponse
    {
        $all = $this->repository->all();
        return response()->json(['data' => $all], HttpResponse::HTTP_OK);
    }

    public function store(): JsonResponse
    {
        // اطمینان از اینکه کلاس Request معتبر تزریق شده
        if (!$this->storeRequest) {
            return response()->json(['error' => 'خطا در فرایند درخواست'], HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

        // اجرای ولیدیشن به‌صورت خودکار توسط لاراول
        $validated = app($this->storeRequest)->validated();

        try {
            $created = $this->repository->create($validated);
            return response()->json([
                'message' => 'آیتم با موفقیت افزوده شد ♥',
                'data' => $created,
            ], HttpResponse::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(int $id): JsonResponse
    {
        $item = $this->repository->find($id);
        if (!$item) {
            return response()->json(['message' => 'موردی یافت نشد!'], HttpResponse::HTTP_NOT_FOUND);
        }

        return response()->json(['data' => $item], HttpResponse::HTTP_OK);
    }

    public function update(int $id): JsonResponse
    {
        if (!$this->updateRequest) {
            return response()->json(['error' => 'خطا در فرایند درخواست'], HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

        $validated = app($this->updateRequest)->validated();
        $item = $this->repository->find($id);

        if (!$item) {
            return response()->json(['message' => 'موردی یافت نشد!'], HttpResponse::HTTP_NOT_FOUND);
        }

        try {
            $updated = $this->repository->update($id, $validated);
            return response()->json([
                'message' => 'آیتم با موفقیت ویرایش شد ♥',
                'data' => $updated,
            ], HttpResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete(int $id): JsonResponse
    {
        $item = $this->repository->find($id);
        if (!$item) {
            return response()->json(['message' => 'موردی یافت نشد!'], HttpResponse::HTTP_NOT_FOUND);
        }

        try {
            $this->repository->delete($id);
            return response()->json(['message' => 'با موفقیت حذف شد ♥'], HttpResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
