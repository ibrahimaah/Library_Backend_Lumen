<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\RatingController;
class BookController extends Controller
{
    public function index()
    {
        try
        {
        
            $books = Book::where('approved','1')->get();
            //Refresh books rates
            $rateController = new RatingController();
            $book_rate = 0;
            foreach($books as $book)
            {
                $book_rate = $rateController->getBookRate($book->id);
                $book = Book::find($book->id);
                $book->rate =$book_rate->getData()->data;
                $book->save();
            }
            $books = Book::where('approved','1')->get();

            return response()->json(['code' => 1 , 'data' =>  $books], 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
        }
        catch(Exception $e)
        {
            return response()->json(['code' => 0 , 'msg' =>  $e->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        try
        {
            $this->validate($request ,[
                'title' => 'required|unique:books',
                'description' => 'required',
                'author' => 'required',
            ]);

            $book = new Book();
            $book->title = $request->title;
            $book->author = $request->author;
            $book->description = $request->description;
            $book->approved = 0;

            if($book->save())
            {
                return response()->json(['code' => 1 , 'data' =>  $book]);
            }
            else
            {
                return response()->json(['code' => 0 , 'msg' =>  'حدث خطأ أثناء إضافة الكتاب'], 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                JSON_UNESCAPED_UNICODE);
            }
        }
        catch(Exception $e)
        {
            return response()->json(['code' => 0 , 'msg' =>  $e->getMessage()]);
        }
    }

    public function update(Request $request,$id)
    {
        try
        {
            $book = Book::findOrFail($id);
            
            $book->title = $request->title;
            $book->author = $request->author;
            $book->description = $request->description;
            
            if($book->save())
            {
                return response()->json(['code' => 1 , 'data' =>  $book]);
            }
            else
            {
                return response()->json(['code' => 0 , 'msg' =>  'حدث خطأ أثناء تعديل البوست']);
            }
        }
        catch(Exception $e)
        {
            return response()->json(['code' => 0 , 'msg' =>  $e->getMessage()]);
        }
    }

    public function delete($id)
    {
        try
        {
            $book = Book::findOrFail($id);
            if($book->delete())
            {
                return response()->json(['code' => 1 , 'data' => $book]);
            }
            else
            {
                return response()->json(['code' => 0 , 'msg' =>  'حدث خطأ أثناء حذف البوست']);
            }
        }
        catch(Exception $e)
        {
            return response()->json(['code' => 0 , 'msg' =>  $e->getMessage()]);
        }
    }

    public function isInFavouriteList($book_id)
    {
        try
        {
            $user = User::findOrFail(auth()->user()->id);
            $books = $user->books;
            $favourite = [];
            
            if(!empty($books->toArray()))
            {
                foreach($books as $book)
                {
                    $favourite[] = $book->id;
                }
            }
            
            if(in_array($book_id,$favourite))
            {
                return response()->json(['code' => 1 , 'data' => true]);
            }
            else
            {
                return response()->json(['code' => 0 , 'msg' => false]);
            }
        }
        catch(Exception $e)
        {
            return response()->json(['code' => 0 , 'msg' =>  $e->getMessage()]);
        }
        
        
    }

    public function search(Request $request)
    {
        try
        {
            $search = $request->search_word;
            $result = Book::where('title', 'LIKE', "%$search%")->orWhere('author', 'LIKE', "%$search%")->get();
            return response()->json(['code' => 1 , 'data' =>  $result], 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
        }
        catch(Exception $e)
        {
            return response()->json(['code' => 0 , 'msg' =>  $e->getMessage()]);
        }
    }
}
