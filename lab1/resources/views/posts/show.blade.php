@extends('layouts.app')

@section('title')Create @endsection

@section('content')
{{-- <h1>{{postIdToShow}}</h1> --}}
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    {{--  --}}
    <div class="card " >
    <div class="card-header">
      Post info
    </div>
   <div class="card-body">
     {{-- @dd($posts['title']) --}}
    Title : {{ $posts['title']}} <br>
    Description:{{ $posts['description']}}
   </div>
  </div>

 <br>
 <br>
 
  <div class="card" >
    <div class="card-header">
      Post Creator info
    </div>
   <div class="card-body">
    Name : {{ $posts['title']}} <br>
    Email : {{ $posts['user']->name}}@gmail.com<br>
    Created at : {{ \Carbon\Carbon::parse($posts['created_at'])->format('l jS \\of F Y h:i:s A')}} <br>

   </div>
   
  </div>

  {{-- add a comment --}}
  <div class="card mt-3 w-75">
    <div class="card-header bg-secondary text-light">
        Post a comment
    </div>
    
    <form action="{{ route('comments.store', ['post' => $posts->id])  }}" method="POST"
        class="row col-10 offset-1 my-2 d-flex justify-content-center">
        @csrf
        <div class="col-lg-9  col-sm-12">
            <input id="input-msg" class="form-control border border-success shadow-sm p-2 mb-1" type="text"
                onfocus="this.placeholder = ''" onblur="this.placeholder ='Enter  your comment'"
                placeholder='Enter your comment' aria-label="default input" autocomplete="off" name="comment" />
        </div>
        <input type="hidden" name="post_id" value="{{ $posts->id }}" />
        <input type="hidden" name="parent" value="App\Models\Post" />
        <button type="submit" id="send-btn" class="btn btn-success ms-2 col-lg-2 col-sm-8">
            <i class="fa-solid fa-paper-plane"></i>
            comment</button>
    </form>
</div>

{{--  --}}


  <div>
    <br>
   <strong> <hr></strong>
    <br>
    <h3>Comments</h2>
   <strong> <hr></strong>
    
    
   {{-- @dd($posts->comments) --}}
   
    {{--  --}}
    
    @foreach ($posts->comments as $comment)
        <div class="row mt-4  p-1 text-dark bg-opacity-25" style="background-color:rgb(238, 236, 236)">
            <div class="row col-12" style="min-height: 80px;">
                <div class="col-8">
                    <p class="col-8 font-weight-normal m-1"> {{ $comment->comment }}</p>
                    <strong class="text-muted"> By: {{ $comment->commentable->user->name }}</strong>
                  </div>
                  <div class="row col-4">
                  {{-- getHumanReadableDateAttribute() --}}
                    <span class=" offset-4 text-right font-italic">{{\Carbon\Carbon::parse($comment['created_at'])->format('l jS \\of F Y h:i:s A')}}</span>
                    <button class="btn btn-primary w-25"
                        href="">Edit</button>

                        

                    <form class="d-inline col p-0 " method="POST" style="margin-left: 2px" action="{{route('comments.delete', ['post' => $posts->id,'comment' => $comment])}}">
                      @csrf
                      @method("DELETE")
                        <button class=" w-50  btn btn-danger border border-info ">Delete</button>
                    </form>
                </div>
            </div>
        </div>
        <hr>
    @endforeach

    {{--  --}}


  </div>
{{-- 

        <form method="POST" action="/posts/store">
            @csrf
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Title</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" value="{{$posts[$id-1]['title']}}" >
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label" value="{{$posts[$id-1]['title']}}" >Post Creator</label>
                <select class="form-control">
                    <option value="1">Ahmed</option>
                    <option value="2">Mohamed</option>

                </select>
            </div>

          <button class="btn btn-success btn-lg">Create</button>
        </form> --}}
@endsection
    
