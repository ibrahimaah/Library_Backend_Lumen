<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class FavouriteController extends Controller
{
    
    public function getFavBooks()
    {
        try
        {
            // $user_id = 5;
            //any book has a rate bigger than 3 then added it to my favourite list
            $user_id = auth()->user()->id;
            $book_ids_current_arr = DB::table('ratings')->where('rating','>=',4)->where('user_id',$user_id)->pluck('book_id')->toArray();
            $user = User::findOrFail($user_id);
            $user->books()->syncWithoutDetaching($book_ids_current_arr);
            // $user = User::findOrFail(5);
            
            return response()->json(['code' => 1 , 'data' =>  $user->books]);
        }
        catch(Exception $e)
        {
            return response()->json(['code' => 0 , 'msg' =>  $e->getMessage()]);
        }
    }

    public function addBookToFavouriteList($book_id)
    {
        try
        {
            $user = User::findOrFail(auth()->user()->id);
            $user->books()->syncWithoutDetaching([$book_id]);
            return response()->json(['code' => 1 , 'data' =>  true]);
        }
        catch(Exception $e)
        {
            return response()->json(['code' => 0 , 'msg' =>  $e->getMessage()]);
        }
    }

    public function removeBookFromFavouriteList($book_id)
    {
        try
        {
            $user = User::findOrFail(auth()->user()->id);
            $user->books()->detach($book_id);
            return response()->json(['code' => 1 , 'data' =>  true]);
        }
        catch(Exception $e)
        {
            return response()->json(['code' => 0 , 'msg' =>  $e->getMessage()]);
        }
    }

    
}
