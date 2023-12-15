<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Book;
use App\Models\User;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function rate($book_id)
    {
        
        try
        {
            $user_id = auth()->user()->id;
            $rating = request()->rating;
            $review = request()->review;
            
            $check_already_rate = Rating::where('user_id',$user_id)->where('book_id',$book_id)->first();
            if($check_already_rate)
            {
                $check_already_rate->rating = $rating;
                $check_already_rate->review = $review;
                
                if($check_already_rate->save())
                {
                    return response()->json(['code' => 1 , 'data' =>  true]);
                }
                else
                {
                    return response()->json(['code' => 0 , 'msg' =>  'حدث خطأ ما ']);
                }
            }
            else 
            {
                $rating_obj = new Rating();
                $rating_obj->rating = $rating;
                $rating_obj->review = $review;
                $rating_obj->user_id = $user_id;
                $rating_obj->book_id = $book_id;
    
                if($rating_obj->save())
                {
                    return response()->json(['code' => 1 , 'data' =>  true]);
                }
                else
                {
                    return response()->json(['code' => 0 , 'msg' =>  'حدث خطأ ما ']);
                }
            }
           
        }
        catch(Exception $e)
        {
            return response()->json(['code' => 0 , 'msg' =>  $e->getMessage()]);
        }
    }

    //Get the Rate of the book
    public function getBookRate($book_id)
    {
        try
        {
            $ratings = Rating::Select('rating')->where('book_id',$book_id)->get()->all();
            $book_rate = 0;
            $i=0;
            foreach($ratings as $rating)
            {
                $book_rate += $rating->rating;
                $i++;
            }
            if($i==0)
            {
                $i=1;
                $book_rate = round($book_rate / $i);
            }
            else 
            {
                $book_rate = round($book_rate / $i);
            }

            return response()->json(['code' => 1 , 'data' =>  $book_rate]);
           
        }
        catch(Exception $e)
        {
            return response()->json(['code' => 0 , 'msg' =>  $e->getMessage()]);
        }
    }

    public function getBookRateAndReview($book_id)
    {
        try
        {
            $book = Book::findOrFail($book_id);
            $data = [];
            $i=0;
            foreach($book->ratings as $row)
            {
                $data[$i]['user'] = User::findOrFail($row->user_id);
                $data[$i]['review'] = $row->review;
                $data[$i]['rating'] = $row->rating;
                $i++;
            }

            return response()->json(['code' => 1 , 'data' =>  $data], 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
           
        }
        catch(Exception $e)
        {
            return response()->json(['code' => 0 , 'msg' =>  $e->getMessage()]);
        }
    }

    public function getMaxRatedBook()
    {
        try
        {
            //get max rated value
            $topRatedBookValue = Book::max('rate');
            //get all books with this value from ratings table
            $topRatedBooks = Book::where('rate',$topRatedBookValue)->where('approved',1)->get()->all();

            return response()->json(['code' => 1 , 'data' =>  $topRatedBooks], 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
           
        }
        catch(Exception $e)
        {
            return response()->json(['code' => 0 , 'msg' =>  $e->getMessage()]);
        }
    }
}
