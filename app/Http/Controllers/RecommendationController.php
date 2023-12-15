<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

class RecommendationController extends Controller
{
    public function getSimilarReaders()
    {
        try
        {
            $user_id = auth()->user()->id;
            // $user_id = 5;
            
            //get favourite books ids for the current reader
            $book_ids_current_arr = DB::table('book_user')->where('user_id',$user_id)->distinct()->pluck('book_id')->toArray();
            
            //current user must have at least three books in his favourite list
            if(empty($book_ids_current_arr) || count($book_ids_current_arr) < 3)
            {
                return response()->json(['code' => 1 , 'data' => []]);
            }

            //get ids of other users
            $user_ids_other_arr = DB::table('book_user')->where('user_id','!=',$user_id)->distinct()->pluck('user_id')->toArray();
            $similar_readers_ids_arr = [];
            foreach($user_ids_other_arr as $user_id)
            {
                $book_ids_user_arr = DB::table('book_user')->where('user_id',$user_id)->distinct()->pluck('book_id')->toArray();
                //we dont care about user who has less than three books in his favourite list
                if(count($book_ids_user_arr) < 3)
                {
                    continue;
                }
                else 
                {
                    $i=0;
                    foreach($book_ids_current_arr as $book_id_current)
                    {
                        if(in_array($book_id_current,$book_ids_user_arr))
                        {
                            $i++;
                        }
                        if($i > 2)
                        {
                            $similar_readers_ids_arr[] = $user_id;
                            break;
                        }
                    }
                   
                }
            }
            $similar_readers = [];
            if(!empty($similar_readers_ids_arr))
            {
                foreach($similar_readers_ids_arr as $similar_reader_id)
                {
                    $similar_readers[] = User::findOrFail($similar_reader_id);
                }
                return response()->json(['code' => 1 , 'data' => $similar_readers], 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                JSON_UNESCAPED_UNICODE);
            }
            else 
            {
                return response()->json(['code' => 1 , 'data' => []]);
            }
           
        }
        catch(Exception $e)
        {
            return response()->json(['code' => 0 , 'msg' =>  $e->getMessage()]);
        }
    }

    //Recommend a book for a user
    // public function recommendBook($book_id , $user_id)
    // {
    //     try
    //     {
    //         if(!$this->isAlreadyRecommended($book_id,$user_id)->getData()->data)
    //         {
    //             DB::table('recommended_books')->insert(
    //                 array(
    //                        'user_id'     =>   $user_id, 
    //                        'book_id'   =>   $book_id
    //                 )
    //            );

    //            return response()->json(['code' => 1 , 'data' =>  true], 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
    //            JSON_UNESCAPED_UNICODE);
    //         }
    //         else 
    //         {
    //             return response()->json(['code' => 0 , 'msg' =>  false]);
    //         }
            
    //     }
    //     catch(Exception $e)
    //     {
    //         return response()->json(['code' => 0 , 'msg' =>  $e->getMessage()]);
    //     }
    // }

    //Check whether this book has already been recommended to current user
    public function isAlreadyRecommended($book_id , $user_id)
    {
        try
        {
            $check_already_recommended = DB::table('recommended_books')->where('user_id',$user_id)->where('book_id',$book_id)->first();
            
            if($check_already_recommended)
            {
                return response()->json(['code' => 1 , 'data' =>  true], 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                JSON_UNESCAPED_UNICODE);
            }

            return response()->json(['code' => 1 , 'data' =>  false], 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
        }
        catch(Exception $e)
        {
            return response()->json(['code' => 0 , 'msg' =>  $e->getMessage()]);
        }
    }

    public function getRecommendedBooks()
    {
        try
        {
            $user_id = auth()->user()->id;
            // $user_id = 5;
            $book_ids_current_arr = DB::table('book_user')->where('user_id',$user_id)->distinct()->pluck('book_id')->toArray();
            
            $similar_readers = $this->getSimilarReaders()->getData()->data;
            $similar_readers_ids = [];
            foreach($similar_readers as $similar_reader)
            {
                $similar_readers_ids[] = $similar_reader->id;
            }
            
            // dd($similar_readers_ids);
            $recommended_books_ids = [];
            foreach($similar_readers_ids as $user_id)
            {
                //get favourite books for this similar reader
                $book_ids_user_arr = DB::table('book_user')->where('user_id',$user_id)->distinct()->pluck('book_id')->toArray();
                
                foreach($book_ids_user_arr as $book_id)
                {
                    if(!in_array($book_id,$book_ids_current_arr))
                    {
                        if(!in_array($book_id,$recommended_books_ids))
                        {
                            $recommended_books_ids[] = $book_id;
                        }
                        
                    }
                }
            }
            
            $recommended_books = Book::whereIn('id',$recommended_books_ids)->get()->all();
            
            return response()->json(['code' => 1 , 'data' =>  $recommended_books], 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
            
        }
        catch(Exception $e)
        {
            return response()->json(['code' => 0 , 'msg' =>  $e->getMessage()]);
        }
    }
}
