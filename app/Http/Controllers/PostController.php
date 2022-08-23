<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ->whereDate('created_at',  '>=',Carbon::now()->subDays(7))
        $posts = Post::orderBy('created_at', 'desc')->get();
        // dd($posts);
        return view('post/list', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post;

        $post->title       = $request->input('title');
        $post->description = $request->input('description');
        // store image
        if($request->hasFile('image')){
            $imageName = time() . '-' . $request->title . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $post->image       = $imageName;
            // $post->save();
        }
        //-- store image
        // $post->image       = $imageName;
        $post->save();
        return redirect()->route('posts.index')->with('status', 'Post added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('post/update', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $destination = public_path('images').$post->image;
        if(File::exists($destination)){
            File::delete($destination);
        }

        $post->title       = $request->input('title');
        $post->description = $request->input('description');
        // store image
        if($request->hasFile('image')){
            $imageName = time() . '-' . $request->title . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }
        //-- store image
        $post->image       = $imageName;
        $post->update();

        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id)->delete();
        return redirect()->back();
    }
}
