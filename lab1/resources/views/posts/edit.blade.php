@extends('layouts.app')

@section('title')Create @endsection
@section('content')
<h2>{{$idToEdit}}</h2>

    
        <form method="POST"  action="/posts/update/{{$idToEdit}}" enctype="multipart/form-data" >
            @csrf
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Title</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" value="{{$posts['title']}}" placeholder="" name="title"  />
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                <textarea  class="form-control" id="exampleFormControlTextarea1" rows="3" name="description">{{$posts['description']}}</textarea>
            </div>
            <br>
            <div class="mb-3">
                <label for="image">Select image:</label>
                <input type="file" id="image" name="image">
            </div>
            
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label ">Post Creator</label>
                <select class="form-control" name="user_id">

                    @foreach ($users as $user)
                     <option value="{{$user['id']}}">{{$user['name']}}</option>
                    @endforeach

                </select>
            </div>

          <button class="btn btn-primary btn-lg" type="submit">Update</button>
        </form>
@endsection
    
