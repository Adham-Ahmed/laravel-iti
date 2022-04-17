<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;

class PostController extends Controller

{

    public $posts;

    public function index()
    {
       
        $this->posts=Post::all();
        return view('posts.index',[
            'posts' => $this->posts,
        ]);
    }

    public function create()
    {
        $users=User::all();
        return view('posts.create',['users'=>$users]);
    }

    public function store()
    {
        // array_push($this->posts,$_POST);
        $data=request()->all(); //same as $_POST
        // dd($data);
        // Post::create($data);
        Post::create(
            [
                'title' =>$data['title'],
                'description' =>$data['description'],
                'user_id' =>$data['post_creator']
            ] 
         );
        return to_route('posts');

        // return redirect()->route('posts');//, ['posts' => $this->posts]
    }

    public function show($postIdToShow)
    {
        // return $postId;
        return view('posts.show',[
            'id' => $postIdToShow,
            'posts' => $this->posts

        ]);
    }

    public function edit($idToEdit)
    {
    //    return "toEdit ${editMe}";
    return view('posts.edit',[
        'idToEdit' => $idToEdit,
        'posts' => $this->posts
        
        ]);

    }

    public function delete($idToDelete)
    {
    return view('posts.delete',[
        'idToDelete' => $idToDelete,
        'posts' => $this->posts
        ]);
    }
}