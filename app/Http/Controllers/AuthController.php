<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthUpdateProfileRequest;
use App\Http\Resources\UserApiResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth:api', ['except' => ['login','register']]);
    }


    public function register()
    {
        // اعتبارسنجی داده‌های ورودی
        $validator = Validator::make(request()->all(), [
            'username' => 'required|string|max:255|min:6',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // ایجاد کاربر جدید
        $user = User::create([
            'username' => request('username'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
        ]);
        ! !!$user && throw new \Error('کاربر ساخته نشد');
        // تولید توکن دسترسی برای کاربر
        $token = auth()->login($user);

        $authUser = \auth()->user();
        $userResource =  userApiResource::make($authUser);
        return response()->json([
            'user' => $userResource,
            'authorisation' => $this->respondWithToken($token)
        ])->cookie('jwt_token', $token, 60, '/', null, true, true, 'None');
    }





    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = \auth()->user();
        if($token){
           $authUser =  userApiResource::make($user);
        }
        return response()->json([
            'user' => $authUser,
            'authorisation' => $this->respondWithToken($token)
        ])->cookie('jwt_token', $token, 60, '/', null, true, true, 'None');
    }

    public function update(AuthUpdateProfileRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $limitRequest = $request->only(['first_name','last_name','email','phone']);
        if ($user->id !== \auth()->user()->id){
            return back()->with('error','شما اجازه ویرایش را ندارید');
        };

        $updatedUser = $user->update($limitRequest);

        dd($updatedUser);


    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        # Here we just get information about current user
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout(); # This is just logout function that will destroy access token of current user

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        # When access token will be expired, we are going to generate a new one wit this function
        # and return it here in response
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        # This function is used to make JSON response with new
        # access token of current user
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
