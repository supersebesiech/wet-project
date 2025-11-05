<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('foryou', compact('posts'));
    }

    /**
     * Display posts for "For You" page.
     * 
     * @return \Illuminate\Http\Response
     */
    public function foryou()
    {
        $posts = Post::all()->sortByDesc('updated_at');
        return view('pages.foryou', compact('posts'));
    }

    /**
     * Display posts for "Profile" page.
     * 
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        // SORT POSTS DESCENDING BY CREATED_AT
        $posts = Post::all()->sortByDesc('created_at');
        return view('pages.profile', compact('posts'));
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        ]);

        Post::create([
            'user_id' => 1,//Auth::id(), 
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        return redirect()->route('profile')
        ->with('success','Post created successfully.');
    }
    

    /**
     * Update the specified resource in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);
        $post = Post::find($id);
        $post->update($request->all());
        return redirect()->route('profile')
        ->with('success','Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect()->route('profile')
        ->with('success','Post deleted successfully.');
    }
    // routes functions
    /**
     * Show the form for creating a new post.
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }
    /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show', compact('post'));
    }
    /**
     * Show the form for editing the specified post.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit', compact('post'));
    }
    }
