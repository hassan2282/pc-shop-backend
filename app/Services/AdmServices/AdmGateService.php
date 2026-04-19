<?php

namespace App\Services\AdmServices;

use App\Http\Requests\Admin\Gate\StoreGateRequest;
use App\Http\Requests\Admin\Gate\UpdateGateRequest;
use App\Repositories\AdmRepo\Gate\AdmGateRepositoryInterface;
use Illuminate\Support\Facades\Cache;
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
        $ip = $request->ip();
        $attemptsKey = "gate_attempts_{$ip}";
        $lockoutTime = 5; // دقیقه
        $attempts = Cache::get($attemptsKey, 0);
        if ($attempts >= 5) {
            $lockoutUntil = Cache::get("{$attemptsKey}_lockout");
            if (now()->lt($lockoutUntil)) {
                return response()->json([
                    'message' => 'شما به دلیل تلاش‌های متوالی ناموفق موقتاً مسدود شده‌اید. این مسدودیت پس از 5 دقیقه برطرف خواهد شد',
                    'wait' => $lockoutUntil->diffInMinutes(now())
                ], 429);
            } else {
                Cache::forget($attemptsKey);
                Cache::forget("{$attemptsKey}_lockout");
            }
        }
        try {
            $realKey = $this->repository->all()->first();
            if (!$realKey) {
                return response()->json(['message' => 'گیت تنظیم نشده است.'], 400);
            }
            $result = Hash::check($request->gkey, $realKey->gkey);
            if ($result === true) {
                // session(['admin_gate' => true]);
                Cache::forget($attemptsKey);
                Cache::forget("{$attemptsKey}_lockout");
                return response()->json(true, 200);
            } else {
                Cache::put($attemptsKey, $attempts + 1, now()->addMinutes($lockoutTime));
                Cache::put("{$attemptsKey}_lockout", now()->addMinutes($lockoutTime), now()->addMinutes($lockoutTime));
                return response()->json(false, 200);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        };
    }
}
