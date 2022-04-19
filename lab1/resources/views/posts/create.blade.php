@extends('layouts.app')

@section('title')Create @endsection

@section('content')
 
        <form method="POST" action="/posts/store" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Title</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="title">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label" >Description</label>
                <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>

            
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label"  >Post Creator</label>
                <select class="form-control" name="user_id">
                    
                    @foreach ($users as $user)
                     <option value="{{$user['id']}}">{{$user['name']}}</option>
                    @endforeach
                </select>
            </div>
            <br>
            <div class="mb-3">
                <label for="img">Select image:</label>
                <input type="file" id="image" name="image">
            </div>

          <button class="btn btn-success btn-lg">Create</button>
        </form>
@endsection
        
