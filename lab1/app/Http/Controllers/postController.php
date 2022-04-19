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
    public $imageName;

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
                'user_id' =>$data['user_id'],
            ]);

            //
            $imageName=$this->processImage($request);
            // dd('after processImage');
            $this->imageName=$imageName;
            //
            $postToAddSlugTo = Post::find($post->id);
            $postToAddSlugTo->slug = $post->slug;
            // 
            //add name of image as well + slug to DB
            $postToAddSlugTo->imageName=$imageName;   
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
            $imageName = time().'.'.$request->image->extension();
            $path=storage_path('app\images\\');

            // $request->image->move($path, $imageName);  
            $request->image->storeAs('images', $imageName);

            // Storage::put( 'images', $image);

            return $imageName;

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
        $imageName=$post->imageName;
        $post->delete();
        $path=storage_path('app\images\\');
        // dd($path.$imageName);
        // Storage::delete($path.$imageName);
        Storage::delete($path.'dFhrBBRBMdXc68XVwbBi4pxm1Sd2drOqOfmWekKA.png');

        
        return to_route('posts');

    }
}
