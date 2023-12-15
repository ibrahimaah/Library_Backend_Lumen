<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;


class UserController extends Controller
{
    public function getMyProfile()
    {
        try
        {
            return response()->json(['code' => 1 , 'data' => User::findOrFail(auth()->user()->id)], 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
        }
        catch(Exception $e)
        {
            return response()->json(['code' => 0 , 'msg' =>  $e->getMessage()]);
        }
    }

    public function getReaderProfile($user_id)
    {
        try
        {
            return response()->json(['code' => 1 , 'data' => User::findOrFail($user_id)], 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
        }
        catch(Exception $e)
        {
            return response()->json(['code' => 0 , 'msg' =>  $e->getMessage()]);
        }
    }

    public function updateMyProfile()
    {
        try
        {
            $username = request()->username;
            $name = request()->name;

            $user = User::findOrFail(auth()->user()->id);
            $check_username_exists = User::where('username',$username)->where('username','!=',$user->username)->first();
            if($check_username_exists)
            {
                return response()->json(['code' => 0 , 'msg' =>  'اسم المستخدم موجود مسبقاً'], 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                JSON_UNESCAPED_UNICODE);
            }
            $user->username = $username;
            $user->name = $name;
            if($user->save())
            {
                return response()->json(['code' => 1 , 'data' => true], 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                JSON_UNESCAPED_UNICODE);
            }
            
        }
        catch(Exception $e)
        {
            return response()->json(['code' => 0 , 'msg' =>  $e->getMessage()]);
        }
    }

    public function updateMyPassword()
    {
        try
        {
            $user = User::findOrFail(auth()->user()->id);
            $user->password = app('hash')->make(request()->newPassword);
            if($user->save())
            {
                return response()->json(['code' => 1 , 'data' => true], 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                JSON_UNESCAPED_UNICODE);
            }
            
        }
        catch(Exception $e)
        {
            return response()->json(['code' => 0 , 'msg' =>  $e->getMessage()]);
        }
    }


    //we have to get them so we can choose one of them then recommend a book to him
    public function getAllOtherUsers()
    {
        try
        {
            $other_users = User::where('id','!=',auth()->user()->id)->get();
            return response()->json(['code' => 1 , 'data' => $other_users], 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
            
            
        }
        catch(Exception $e)
        {
            return response()->json(['code' => 0 , 'msg' =>  $e->getMessage()]);
        }
    }
}
