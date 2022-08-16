@extends('layouts.app')

@section('content')

<div style="margin: 50px">
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div>
            <a href="{{ route('posts.index') }}" style="text-decoration: none;">Post List</a>
        </div>
        <div style="margin-top: 10px">
            <label for="title">Title:</label>
            <input style="margin-right: 100px" type="text" name="title">
        
            <label for="description">Description:</label>
            <input style="margin-right: 100px" type="text" name="description">

            <label for="image">Image</label>
            <input type="file" name="image">
        </div>
        <div>
            <button style="margin-top: 10px" type="submit">Create</button>
        </div>
    
    </form>
</div>



@endsection