@extends('layouts.app')

@section('title')Create @endsection
@section('content')
<h2>{{$idToEdit}}</h2>

    
        <form method="POST" action="/posts/update/{{$idToEdit}}">
            @csrf
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Title</label>
                {{-- @dd($posts['title']) --}}
                <input type="text" class="form-control" id="exampleFormControlInput1" value="{{$posts['title']}}" placeholder="" name="title"  />
                {{-- posts[0].['title'] --}}
            </div>
            <div class="mb-3">
                {{-- @dd($posts['description']) --}}
                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                <textarea  class="form-control" id="exampleFormControlTextarea1" rows="3" name="description">{{$posts['description']}}</textarea>
            </div>
            {{-- @dd($posts->user->id) --}}

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label ">Post Creator</label>
                <select class="form-control" name="post_creator">
                    {{-- @foreach ($posts->user as $user) --}}
                    {{-- @dd($posts->user->id) --}}
                     <option value="{{$posts->user->id}}">{{$posts->user->name}}</option>
                    {{-- @endforeach --}}

                </select>
            </div>

          <button class="btn btn-primary btn-lg">Update</button>
        </form>
@endsection
    
