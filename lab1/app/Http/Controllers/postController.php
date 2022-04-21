<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Http\Requests\StorePostRequest;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
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
       

            $request->validate([
                'image' => 'required|image|mimes:png,jpg',
            ]);
    
                $image= $request->file('image');
                $imageName = Storage::putFile("images",$image);

                //@param  \Illuminate\Http\Request  $request
                $post=Post::create(
                    [
                        'title' =>$data['title'],
                        'description' =>$data['description'],
                        'user_id' =>$data['user_id'],
                        'imageName' =>$imageName,
                    ]);

            //
            $postToAddSlugTo = $post;//for readability of next line
            $postToAddSlugTo->slug = $post->slug;  
            $postToAddSlugTo->save();
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
        $users=User::all();

          return view('posts.edit',[
            'idToEdit' => $idToEdit,
            'posts' => $this->posts,
            'users'=>$users
        
        ]);
    }

    public function update(Request $request,$id)
    {
        // $request->validate([
        //     'image' => 'required|image|mimes:png,jpg',
        // ]);
        // dd($request->file('image'));
        ////////// <CONTINUE_FROM_HERE></CONTINUE_FROM_HERE>
        $request->validate([
            'title' => 'required|string|min:3',
            'imageName' => 'nullable|image|mimes:jpg,png',
            'description' => 'required|string|min:10',
            'user_id' => 'required|exists:users,id',
        ]);

        $data=request()->all(); //same as $_POST
        $post = Post::find($id);
        $post->title = $data['title'];
        $post->description = $data['description'];
        $post->user_id = $data['user_id'];
        // dd($post);
        //if image is sent in request
        //HERE####################
        // dd($request('image'));
        //file not seen as sent so below if block not executed
        if($request->hasFile('image')){
            $request->validate([
                'image' => 'required|image|mimes:png,jpg',
            ]);

            //1) delete old image from filesystems
            if ($post->imageName) {
                Storage::delete($post->imageName);
            }/////
            //2)save new image to filesys.
            $image= $request->file('image');
            $imageName = Storage::putFile("images",$image);
            //3)save new image name to DB
            $post->imageName = $imageName;

            $postToEditSlugFor= $post;//for readability of next line
            $postToEditSlugFor->slug = $post->slug;
         }
        
        $post->save();
        return to_route('posts');
    }

    public function delete($idToDelete)
    {
    return view('posts.delete',[
        'idToDelete' => $idToDelete,
        ]);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $imageName=$post->imageName;

        Storage::delete($imageName);/////
        $post->delete();
             
        return to_route('posts');
    }

}
