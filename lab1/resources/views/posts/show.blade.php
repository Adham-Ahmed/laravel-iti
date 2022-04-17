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
    Created at : {{ $posts['created_at']}} <br>

   </div>
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
    
