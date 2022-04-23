<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Post;
use App\http\Requests\StorePostRequest;
use App\http\Resources\PostResource;


class PostController extends Controller
{
    Public function index(){
        // $posts = Post::with('user')->get();
        // $posts=Post::paginate(10)->withQueryString(); 
        $posts = Post::with('user')->paginate(10);
        return PostResource::collection($posts);
    }

    Public function show($posdId){
        $post=Post::find($posdId);   
        return new PostResource($post);
    }

    public function store(StorePostRequest $request)
    {
         $data=request()->all(); //same as $_POST 
       
                $post=Post::create(
                    [
                        'title' =>$data['title'],
                        'description' =>$data['description'],
                        'user_id' =>$data['user_id'],
                    ]);
            // return $post;
            return new PostResource($post);
        }
}
