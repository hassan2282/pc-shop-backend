<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckEmailRequest;
use App\Http\Requests\CheckVerify;
use App\Http\Requests\NewPassRequest;
use App\Models\Verification_code;
use App\Http\Requests\StoreVerification_codeRequest;
use App\Http\Resources\userApiResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class VerificationCodeController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVerification_codeRequest $request)
    {

        $storeCode = Verification_code::create([
            'phone' => request('phone'),
            'code' => rand(1000, 9999),
            'expires_at' => now()->addMinutes(2),
        ]);

        return response()->json($storeCode);
    }



    public function checkVerify(CheckVerify $request)
    {

        try {
            $ip = $request->ip();
            $phone = $request[1];
            $clientIP = "gate_attempts_{$ip}";
            $expireTime = 5;
            $attempts = Cache::get($clientIP, 0);
            if ($attempts >= 5) {
                $remainTime = Cache::get("{$clientIP}_lockout");
                if (now()->lt($remainTime)) {
                    $this->rmExpiredCodes('phone', $phone);
                    return response()->json([
                        'message' => 'شما به دلیل تلاش‌های متوالی ناموفق موقتاً مسدود شده‌اید. این مسدودیت پس از 5 دقیقه برطرف خواهد شد',
                        'wait' => $remainTime->diffInMinutes(now())
                    ], 429);
                }
            }
            $code = '';
            foreach ($request[0] as $item) {
                $code .= $item;
            }

            $lastCode = Verification_code::where('phone', $phone)->orderBy('id', 'DESC')->limit(1)->first();

            if ($lastCode->code === $code) {
                $lastCode->update(['used' => true,]);
                $user = User::where('phone', $phone)->first();
                if ($user) {
                    $token = auth()->login($user);
                    $authUser = auth()->user();
                    $userResource =  userApiResource::make($authUser);
                    Cache::forget($clientIP);
                    Cache::forget("{$clientIP}_lockout");
                    $this->rmExpiredCodes('phone', $phone);
                    return response()->json([
                        'user' => $userResource,
                        'authorisation' => $this->respondWithToken($token)
                    ])->cookie('jwt_token', $token, 10080, '/', null, true, true, 'None');
                } else {
                    $newUser = User::create([
                        'phone' => $phone,
                    ]);
                    $token = auth()->login($newUser);
                    $authUser = auth()->user();
                    $userResource =  userApiResource::make($authUser);
                    Cache::forget($clientIP);
                    Cache::forget("{$clientIP}_lockout");
                    $this->rmExpiredCodes('phone', $phone);
                    return response()->json([
                        'user' => $userResource,
                        'authorisation' => $this->respondWithToken($token)
                    ])->cookie('jwt_token', $token, 10080, '/', null, true, true, 'None');
                }
            } else {
                Cache::put($clientIP, $attempts + 1, now()->addMinutes($expireTime));
                Cache::put("{$clientIP}_lockout", now()->addMinutes($expireTime), now()->addMinutes($expireTime));
                return response()->json(false);
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }





    public function forgetPassword(Request $request)
    {

        $validation = Validator::make(
            $request->all(),
            [
                'email' => 'required|exists:users'
            ],
            [
                'email.required' => 'ایمیل الزامی است',
                'email.exists' => 'ایمیل وارد شده یافت نشد',
            ]
        );
        if ($validation->fails()) {
            throw new \Error('ایمیل خود را با دقت وارد نمایید');
        }
        try {
            $storeCode = Verification_code::create([
                'email' => request('email'),
                'code' => rand(1000, 9999),
                'expires_at' => now()->addMinutes(2),
            ]);
            return response()->json($storeCode);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function checkEmailCode(CheckEmailRequest $request)
    {
        try {
            $email = $request->email;
            $ip = $request->ip();
            $clientIP = "gate_attempts_{$ip}";
            $expireTime = 5;  // توجه اینجا را به 5 تغییر بده لطفا و حتما توجه کن ///////////////////////
            $attempts = Cache::get($clientIP, 0);
            if ($attempts >= 5) { // توجه اینجا را به 5 تغییر بده لطفا و حتما توجه کن ///////////////////////
                $remainTime = Cache::get("{$clientIP}_lockout");
                if (now()->lt($remainTime)) {
                    $this->rmExpiredCodes($email);
                    return response()->json([
                        'message' => 'شما به دلیل تلاش‌های متوالی ناموفق موقتاً مسدود شده‌اید. این مسدودیت پس از 5 دقیقه برطرف خواهد شد',
                        'wait' => $remainTime->diffInMinutes(now())
                    ], 429);
                }
            }
            $code = Str::replace(',', '', $request->otp);

            $lastCode = Verification_code::where('email', $email)->orderBy('id', 'DESC')->limit(1)->first();
            if ($lastCode->code === $code) {
                $lastCode->update(['used' => true,]);
                Cache::forget($clientIP);
                Cache::forget("{$clientIP}_lockout");
                $this->rmExpiredCodes('email', $email);
                return response()->json(true);
            } else {
                Cache::put($clientIP, $attempts + 1, now()->addMinutes($expireTime));
                Cache::put("{$clientIP}_lockout", now()->addMinutes($expireTime), now()->addMinutes($expireTime));
                return response()->json(false);
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }




    public function setNewPassword(NewPassRequest $request)
    {
        try{
            $user = User::where('email', $request->email)->first();
            $update = $user->update([
                'password' => bcrypt($request->password),
            ]);
            if ($user) {
                $token = auth()->login($user);
                $authUser = auth()->user();
                $userResource =  userApiResource::make($authUser);
                return response()->json([
                    'user' => $userResource,
                    'authorisation' => $this->respondWithToken($token)
                ])->cookie('jwt_token', $token, 10080, '/', null, true, true, 'None');
            };
        }catch(\Exception $e){
            return response()->json($e->getMessage(), HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }




    public function destroy(Request $request)
    {
        try {
            $all_codes = Verification_code::where('phone', $request->phone)->get();
            foreach ($all_codes as $code) {
                $code->delete();
            }
            return response()->json('ok', HttpResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    private function rmExpiredCodes(string $column, string $target)
    {
        $all_codes = Verification_code::where($column, $target)->get();
        foreach ($all_codes as $code) {
            $code->delete();
        }
    }


    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 10080
        ]);
    }
}
