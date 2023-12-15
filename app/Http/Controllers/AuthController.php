<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:api', ['except' => ['login']]);
    }
    public function register(Request $request)
    {
        $name = $request->name;
        $username = $request->username;
        $password = $request->password;

        // Check if field is empty
        if (empty($name) or empty($username) or empty($password)) 
        {
            return response()->json(['code' => 0 , 'msg' => 'يجب عليك ملء كل الحقول']);
        }

       

        // Check if password is greater than 5 character
        if (strlen($password) < 6) 
        {
            return response()->json(['code' => 0 , 'msg' => 'يجب أن تكون كلمة المرور على الأقل 6 محارف']);
        }

        // Check if user already exist
        if (User::where('username', '=', $username)->exists()) 
        {
            return response()->json(['code' => 0 , 'msg' => 'اسم المستخدم موجود مسبقاً']);
        }

        // Create new user
        try 
        {
            $user = new User();
            $user->name = $request->name;
            $user->username = $request->username;
            $user->password = app('hash')->make($request->password);

            if ($user->save()) 
            {
                return $this->login($request);
            }
        } 
        catch (Exception $e) 
        {
            return response()->json(['code' => 0 , 'msg' =>  $e->getMessage()]);
        }
    }
    public function login(Request $request)
    {
        try
        {
            $username = $request->username;
            $password = $request->password;

            if(empty($username) or empty($password))
            {
                return response()->json(['code' => 0 , 'msg' => 'يجب عليك ملء كل الحقول']);
            }

            $credentials = request(['username', 'password']);

            if (! $token = auth()->attempt($credentials)) 
            {
                return response()->json(['code' => 0 , 'msg' => 'فشلت عملية تسجيل الدخول']);
            }

            return $this->respondWithToken($token);
        }
        catch(Exception $e)
        {
            return response()->json(['code' => 0 , 'msg' =>  $e->getMessage()]);
        }

    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'code' => 1,
            'data'=> [
                'access_token' => $token,
                'user' => auth()->user(),
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60 * 60
            ]
        ]);
    }

    public function logout()
    {
        try 
        {
            auth()->logout();
            return response()->json(['code' => 1]);
        } 
        catch(Exception $e)
        {
            return response()->json(['code' => 0 , 'msg' =>  $e->getMessage()]);
        }
    }

    public function checkToken()
    {
        try 
        {
            JWTAuth::parseToken()->authenticate();
            return response()->json(['code' => 1]);
        } 
        catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) 
        {
    
            return response()->json(['code' => 0 , 'msg' =>  $e->getMessage()]);
    
        } 
        catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) 
        {
    
            return response()->json(['code' => 0 , 'msg' =>  $e->getMessage()]);
    
        } 
        catch (\Tymon\JWTAuth\Exceptions\JWTException $e) 
        {
    
            return response()->json(['code' => 0 , 'msg' =>  $e->getMessage()]);
        }
    }
}
