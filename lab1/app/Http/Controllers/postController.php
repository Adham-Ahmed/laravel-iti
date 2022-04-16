<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller

{

    public $posts = [
        ['id' => 1, 'title' => 'Food', 'post_creator' => 'Adham', 'created_at' => '2022-04-16 10:37:00'],
        ['id' => 2, 'title' => 'Chess', 'post_creator' => 'Amal', 'created_at' => '2022-04-16 10:37:00'],
        ['id' => 3, 'title' => 'Programming', 'post_creator' => 'Ahmed', 'created_at' => '2022-04-16 10:37:00'],
        ['id' => 4, 'title' => 'Laravel', 'post_creator' => 'Omar', 'created_at' => '2022-04-16 10:37:00'],
        ['id' => 5, 'title' => 'Fashion', 'post_creator' => 'mariam', 'created_at' => '2022-04-16 10:37:00'],
    ];

    public function index()
    {
       
        
        return view('posts.index',[
            'posts' => $this->posts,
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        return 'we are in store';
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