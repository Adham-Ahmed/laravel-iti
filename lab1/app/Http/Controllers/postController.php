<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Http\Requests\StorePostRequest;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;
// use App\Jobs\PruneOldPostsJob;

class PostController extends Controller

{

    public $posts;

    public function index()
    {  
       
        $posts=Post::all();
        $this->posts=Post::paginate(10)->withQueryString();
        // PruneOldPostsJob::dispatch($posts);
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
         $data=request()->all(); //same as $_POST         
         $post=Post::create(
            [
                'title' =>$data['title'],
                'description' =>$data['description'],
                'user_id' =>$data['user_id']
            ]);

            //

            $this->processImage($request);

            //
            $postToAddSlugTo = Post::find($post->id);
            $postToAddSlugTo->slug = $post->slug;         
            $postToAddSlugTo->save();
            return to_route('posts');
    }

    public function processImage($request)
    {
        $data=request()->all();

        $request->validate([
            'image' => 'required|image|mimes:png,jpg',
        ]);

            $image= $request->file('image');
            dd($image);
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);  
            $request->image->storeAs('images', $imageName);
            // Storage::disk('local')->put('images/1/smalls'.'/'.$imageName, $image, 'public');

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



// Read what is Queue job and database queue driver then create Queue Job called PruneOldPostsJob
// that when dispatched it deletes posts that are created from 2 years ago …. check mohamed said
// video to understand more
// - Read what is Task Scheduling then schedule PruneOldPostsJob to run daily at midnight
// - Upload image to post , and validate extensions are only
//  (.jpg, .png) , and use Storage to store and show images also when updating post we remove the old 
// image, and when deleting post we remove the old image
// https://laravel.com/docs/master/filesystem#file-uploads
// Hint:- see if Mutators can make your code cleaner
