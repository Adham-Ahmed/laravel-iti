<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller

{

    public $posts;

    public function index()
    {  
       
        // $this->posts=Post::all();
        $this->posts=Post::paginate(10)->withQueryString();
        return view('posts.index',[
            'posts' => $this->posts
        ]);
    }

    public function create()
    {
        $users=User::all();
        return view('posts.create',['users'=>$users]);
    }
    public function store(StorePostRequest $request)
    {
        // $request = new StorePostRequest();
        // request()->validate
        // request()->validate(
        //     [
        //         'title' => 'required',
        //         'description' => 'required',
        //     ]
        //     );

        $data=request()->all(); //same as $_POST
        dd($data);
        Post::create(
            [
                'title' =>$data['title'],
                'description' =>$data['description'],
                'user_id' =>$data['post_creator']
            ] 
         );
        return to_route('posts');

    }

    public function show($postIdToShow)
    {
        $this->posts=Post::find($postIdToShow);
        return view('posts.show',[
            'id' => $postIdToShow,
            'posts' => $this->posts

        ]);
    }

    public function edit($idToEdit)
    {
        $this->posts=Post::find($idToEdit);
    return view('posts.edit',[
        'idToEdit' => $idToEdit,
        'posts' => $this->posts
        
        ]);

    }

    public function update($id)
    {
        $data=request()->all(); //same as $_POST

        $post = Post::find($id);
 
        $post->title = $data['title'];
        $post->description = $data['description'];['title'];
         
        $post->save();
        return to_route('posts');
    }

    public function delete($idToDelete)
    {
    return view('posts.delete',[
        'idToDelete' => $idToDelete,
        // 'posts' => $this->posts
        ]);
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return to_route('posts');

    }
}