@extends('layouts.app')

@section('content')

<form action="{{ route('posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    @method('PUT')
    <div style="margin-left: 50px">
        <a href="{{ route('posts.index') }}" style="text-decoration: none;">Post List</a>
    </div>
    <div style="margin-left: 50px; margin-top: 10px">
        <label for="title">Title:</label>
        <input style="margin-right: 100px" type="text" name="title" value={{ $post->title }}>

        <label for="description">Description:</label>
        <input type="text" name="description" value={{ $post->description }}>
    </div>
    <div style="margin-left: 50px; margin-top: 10px">
        <label for="image">Image</label>
        <input type="file" name="image" style="margin-bottom: 5px"><br>
        <img src="{{ asset('images/' . $post->image) }}" width="90" height="90" alt="image">
    </div>
    <div>
        <button style="margin-top: 10px; margin-left: 50px" type="submit">Update</button>
    </div>

</form>


@endsection