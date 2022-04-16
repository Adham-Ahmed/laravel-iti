@extends('layouts.app')

@section('title')Create @endsection
@section('content')
<h2>{{$idToEdit}}</h2>
{{-- <h2>{{dd($posts[0]['title'])}}</h2> --}}
<script>
    var title=posts[$idToEdit].['title']
    var post_creator=posts[$idToEdit].['post_creator']
   
    var created_at=posts[$idToEdit].['created_at']
</script>
    
        <form method="POST" action="/posts/store">
            @csrf
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Title</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" value="{{$posts[$idToEdit-1]['title']}}" placeholder=""  />
                {{-- posts[0].['title'] --}}
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label ">Post Creator</label>
                <select class="form-control" >
                    <option value="1">Ahmed</option>
                    <option value="2">Mohamed</option>

                </select>
            </div>

          <button class="btn btn-primary btn-lg">Update</button>
        </form>
@endsection
    
