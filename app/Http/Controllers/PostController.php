<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(Request $request)
    {
        try
        {
            $posts = Post::all();
            foreach($posts as $post){
                 $post->user;
            }

            return response()->json(['code' => 1 , 'data' => $posts]);
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
            $post = new Post();
            $post->title = $request->title;
            $post->body = $request->body;
            $post->user_id = auth()->user()->id;

            if($post->save())
            {
                return response()->json(['code' => 1 , 'data' =>  $post]);
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

    public function update(Request $request,$id)
    {
        try
        {
            $post = Post::findOrFail($id);
            $post->title = $request->title;
            $post->body = $request->body;
            $post->user_id = auth()->user()->id;
            
            if($post->save())
            {
                return response()->json(['code' => 1 , 'data' =>  $post]);
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
            $post = Post::findOrFail($id);
            if($post->delete())
            {
                return response()->json(['code' => 1 , 'data' =>  $post]);
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

    public function getCommentsByPost($id)
    {
        try
        {
            $post = Post::findOrFail($id);
            $comments = $post->comments;
            foreach($comments as $comment){
                 $comment->user;
            }
            if($comments)
            {
                return response()->json(['code' => 1 , 'data' =>  $comments]);
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
