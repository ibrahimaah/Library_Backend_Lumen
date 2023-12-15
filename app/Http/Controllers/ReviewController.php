<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Book;
use App\Models\User;
use App\Models\Review;


class ReviewController extends Controller
{
    public function getBookReviews($book_id)
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
                $i++;
            }

            return response()->json(['code' => 1 , 'data' =>  $data], 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
           
        }
        catch(Exception $e)
        {
            return response()->json(['code' => 0 , 'msg' =>  $e->getMessage()]);
        }
        catch(Exception $e)
        {
            return response()->json(['code' => 0 , 'msg' =>  $e->getMessage()]);
        }
        
    }

    /*
    public function addReview($book_id)
    {
        
        try
        {
            //one user can only add one review
            //prevent user from reviewing a book more than one time
            $user_id = auth()->user()->id;
            $previous_review = Review::where('user_id',$user_id)->first();

            if(!$previous_review)
            {
                $review_obj = new Review();
                $review_obj->review = request()->review; 
                $review_obj->user_id = $user_id;
                $review_obj->book_id = $book_id;

                if($review_obj->save())
                {
                    return response()->json(['code' => 1 , 'data' =>  $review_obj]);
                }
                else
                {
                    return response()->json(['code' => 0 , 'msg' =>  'حدث خطأ ما ']);
                }
            }
            else 
            {
                //If the reader already add a review then update the previous review
                $previous_review->review = request()->review; 
                $previous_review->user_id = $user_id;
                $previous_review->book_id = $book_id;

                if($previous_review->save())
                {
                    return response()->json(['code' => 1 , 'data' =>  $previous_review]);
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
    */
    
    /*
    public function deleteReview($review_id)
    {
        try
        {
            $review_obj = Review::findOrFail($review_id);
            $review_obj->delete();
            return response()->json(['code' => 1 , 'data' =>  true]);
           
        }
        catch(Exception $e)
        {
            return response()->json(['code' => 0 , 'msg' =>  $e->getMessage()]);
        }
    }
    */
}
