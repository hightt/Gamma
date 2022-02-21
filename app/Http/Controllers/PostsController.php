<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')
            ->only([
                'destroy',
                'store',
                'update',
            ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index')->with('posts', Post::orderBy('created_at', 'DESC')->paginate(10));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        Post::create(array_merge($request->only('title', 'content'), ['user_id' => Auth::user()->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post')->with('post', $post)
                            ->with('comments', $post->comments()->orderBy('created_at', 'DESC')->paginate(5));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
       Post::destroy($post->id);
    }

    public function search(Request $request)
    {
        $posts = Post::where('title', 'LIKE', '%'. $request->search_name .'%')
                    ->orWhere('content', 'LIKE', '%'. $request->search_name .'%')->paginate(10);
        return view('index')->with('posts', $posts);
    }

    public function myTopics()
    {
        return view('index')
        ->with('posts', Post::where('user_id', Auth::user()->id)->paginate(10));
    }

    public function myAnswers()
    {

        return view('index')->with('comments', User::find(Auth::user()->id)->comments()->get());
    }
}
