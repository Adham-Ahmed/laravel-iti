@extends('layouts.app')

@section('title')Index @endsection

@section('content')
        <div class="text-center">
            <a href="/posts/create" class="mt-4 btn btn-success">Create Post</a>
        </div>
        <table class="table mt-4">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Posted By</th>
                <th scope="col">Slug of title</th>
                <th scope="col">Created At</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
             
            @foreach ( $posts as $post) 
            {{-- @dd($post->user->name)   --}}
              <tr>
                <td>{{ $post['id'] }}</th>
                <td>{{ $post['title'] }}</td>
                <td>{{ $post->user->name }}</td>
                <td>{{ $post['slug'] }}</td>
                <td>{{ \Carbon\Carbon::parse( $post->created_at )->toDateString(); }}</td>
                {{-- <td>{{ $post['created_at'] }}</td> --}}
                <td>
                    <a href="/posts/show/{{$post['id']}}" class="btn btn-info">View</a>
                    <a href="/posts/edit/{{$post['id']}}" class="btn btn-primary">Edit</a>
                    <a href="/posts/delete/{{$post['id']}}" class="btn btn-danger">Delete</a>
                </td>
              </tr>
              @endforeach

              
            </tbody>
          </table>
@endsection

@section('paginate')
  {{ $posts->links('pagination::bootstrap-4')}}
@endsection


 