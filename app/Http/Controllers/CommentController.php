<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        try
        {
            $comment = new Comment();
            $comment->comment = $request->comment;
            $comment->post_id = $request->post_id;
            $comment->user_id = auth()->user()->id;

            if($comment->save())
            {
                return response()->json(['code' => 1 , 'data' =>  $comment]);
            }
            else
            {
                return response()->json(['code' => 0 , 'msg' =>  'حدث خطأ أثناء إضافة البوست']);
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
            $comment = Comment::findOrFail($id);
            if($comment->delete())
            {
                return response()->json(['code' => 1 , 'data' =>  $comment]);
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
}
