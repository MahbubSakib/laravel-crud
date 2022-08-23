@extends('layouts.app')

@section('content')

    {{-- <link rel="stylesheet" href="app.css"> --}}
    <div class="contain">
        <div>
            <a href="{{ route('posts.create') }}" class="button"><i
                class="icon-plus-circle2"></i><span>Create New</span>
            </a>
        </div>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Created</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->description }}</td>
                            <td>
                                <img src="{{ asset('images/' . $post->image) }}"
                                style="border-radius: 50%"
                                width= "90" height= "90" alt="image">
                            </td>
                            <td>{{ $post->created_at->format('d/m/Y') }}</td>
                            <td>
                                <ul style="list-style-type: none">
                                    <li style="display: inline-block;">
                                        <a href="{{ route('posts.edit', $post->id) }}">
                                            <button style="margin-bottom: 5px; margin-top: 5px" type="submit" class="btn btn-primary">Edit</button>
                                        </a>
                                    </li>
                                    <li style="display: inline-block;">
                                        <form action="{{ route('posts.destroy',$post->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>



@endsection