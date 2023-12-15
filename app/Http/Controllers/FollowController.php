<?php

namespace App\Http\Controllers;


use Exception;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class FollowController extends Controller
{
    //check already similar reader if has been followed before
    public function isAlreadyFollowed($similar_reader_id)
    {
        try
        {
            $res = DB::table('similar_readers')->where('similar_reader_id',$similar_reader_id)->first();
            if($res)
            {
                return response()->json(['code' => 1 , 'data' => true]);
            }
            else 
            {
                return response()->json(['code' => 1 , 'data' => false]);
            }
        
        }
        catch(Exception $e)
        {
            return response()->json(['code' => 0 , 'msg' =>  $e->getMessage()]);
        }
    }

    //follow a similar reader
    public function follow($similar_reader_id)
    {
        try 
        {
            if(!($this->isAlreadyFollowed($similar_reader_id))->getData()->data)
            {
                DB::table('similar_readers')->insert(
                    ['user_id' => auth()->user()->id , 'similar_reader_id' => $similar_reader_id]
                );
                return response()->json(['code' => 1 , 'data' => true]);
            }

            return response()->json(['code' => 0 , 'msg' =>  'هذا القارئ تمت متابعته مسبقاً'], 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                JSON_UNESCAPED_UNICODE);
        }
        catch(Exception $e)
        {
            return response()->json(['code' => 0 , 'msg' =>  $e->getMessage()]);
        }
    }

    //follow a similar reader
    public function unFollow($similar_reader_id)
    {
        try 
        {
            if($this->isAlreadyFollowed($similar_reader_id))
            {
                DB::table('similar_readers')->where('similar_reader_id', '=', $similar_reader_id)->delete();
                return response()->json(['code' => 1 , 'data' => true]);
            }

            return response()->json(['code' => 0 , 'msg' =>  'حدث خطأ ما'], 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                JSON_UNESCAPED_UNICODE);
        }
        catch(Exception $e)
        {
            return response()->json(['code' => 0 , 'msg' =>  $e->getMessage()]);
        }
    }
    
    //get followed users
    public function getFollowedSimilarReaders()
    {
        try 
        {
            $data = [];
            $followedSimilarReaders = DB::table('similar_readers')->where('user_id',auth()->user()->id)->get()->all();
            if($followedSimilarReaders)
            {
                foreach($followedSimilarReaders as $followedSimilarReader)
                {
                    $data[] = User::findOrFail($followedSimilarReader->similar_reader_id);
                }
                if($followedSimilarReaders)
                {
                    return response()->json(['code' => 1 , 'data' => $data]);
                }
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
    //get news feed depending on the following similar readers
    
    public function getPostsByFollowedSimilarReaders()
    {
        try
        {
            $similar_readers = $this->getFollowedSimilarReaders();
            
            //get the ids of similar readers
            $similar_readers_ids = [];

            if($similar_readers)
            {
                foreach($similar_readers->getData()->data as $similar_reader)
                {
                    $similar_readers_ids[] = $similar_reader->id;
                }
                
                //add current user id to get his posts
                $similar_readers_ids[] = auth()->user()->id;

                $posts = Post::whereIn('user_id',$similar_readers_ids)->get()->all();
                foreach($posts as $post){
                    $post->user;
                }

                return response()->json(['code' => 1 , 'data' => $posts], 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
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
}
