
@extends('layouts.app')

@section('title')Create @endsection
@section('content')

    {{-- change to delete method , using smth other than form probably --}}
<form method="POST" action="/posts/destroy/{{$idToDelete}}">
            @csrf
            @method('delete')
            <h2>Are you sure u want to delete ?</h2>
            <button class="btn btn-danger"type="submit">Delete</button>
            <br>
            <br>
            <a href="/posts/">Take me back to Posts</a>
        </form>
@endsection
    



    {{-- <form method="POST" action="/posts/destory/{{$idToDelete}}">
        <h2>Are you sure u want to delete ?</h2>
        <button type="submit">I am sure</button>
        <br>
        <br>
        <a href="/posts/">Take me back to Posts</a>
    </form> --}}
    
