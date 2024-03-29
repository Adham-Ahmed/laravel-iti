<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCommentRequest  $request
     * @return RedirectResponse
     */
    // public function store(Post $post, StoreCommentRequest $request)
    // {
    //     //
    //     $comment = new Comment($request->all());
    //     $comment->post_id = $post->id;
    //     $comment->save();
    //     return to_route("posts.show", ['post' => $post]);
    // }

    ////////////////////////////////////////////////////////////////
    public function store(Request $request)
    {
        // dd($request);
        // dd(Auth::user()->id);
        $comment =  Comment::create([
            // 'comment' => "hard coded",
            'comment' => $request->comment,
            'user_id' => Auth::user()->id,
            'commentable_id' => $request->post_id,
            'commentable_type' => $request->parent
        ]);

        return redirect()
            ->route('posts.show', [
                'post' => $request->post_id,
            ])
            ->with('success', "your comment is added ");
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCommentRequest  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
    public function delete(Post $post, $commentID): RedirectResponse
    {
        // dd(Comment::where('id', $commentID)->get());        
        // Comment::where('id','=', $commentID)->delete();
        // dd($post->comments->find($commentID));
        $post->comments->find($commentID)->delete();
        return to_route("posts.show",['post'=>$post->id]);
    }
    public function restore(Post $post, int $comment): RedirectResponse
    {
        Comment::withTrashed()->find($comment)->restore();
        return to_route("posts.show",['post'=>$post]);
    }
}