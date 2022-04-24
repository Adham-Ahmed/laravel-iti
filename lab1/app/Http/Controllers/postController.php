<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdateRequest;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class PostController extends Controller

{

    public $posts;
    public $imageName;

    public function index()
    {  
       
        $posts=Post::all();
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
         $data=request()->all(); //same as $_POST 
         $imageName="not_uploaded";        
            if($request->hasFile('images'))
                {
                $image= $request->file('image');
                $imageName = Storage::putFile("images",$image);
                }

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

        $posts=Post::find($postIdToShow);

        // dd($posts->comments->all());

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

    public function update(UpdateRequest $request,$id)
    {
        $data=request()->all(); //same as $_POST
        $post = Post::find($id);
        $post->title = $data['title'];
        $post->description = $data['description'];
        $post->user_id = $data['user_id'];

        if($request->hasFile('image')){
            $request->validate([
                'image' => 'image|mimes:png,jpg',
            ]);

            //1) delete old image from filesystems
            if ($post->imageName) {
                Storage::delete($post->imageName);
            }
            //2)save new image to filesys.
            $image= $request->file('image');
            $imageName = Storage::putFile("images",$image);
            //3)save new image path to DB
            $post->imageName = $imageName;

            
        }
        $post->slug=null;
        $post->slug = $post->slug;//slug field in DB = slugged title
        
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

        if($imageName)
        {
        Storage::delete($imageName);/////

        }
        $post->delete();
             
        return to_route('posts');
    }

}
