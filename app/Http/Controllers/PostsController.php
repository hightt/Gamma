<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Database\Schema\Builder;
use Illuminate\Database\Eloquent\Builder;
class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        return view('index');
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
        Post::create(['title' => $request->post_title, 'content' => $request->post_content, 'user_id' => Auth::user()->id]);
        return back()->withInput()->with('message', 'Pomyślnie dodano post!'); ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('sections.post')->with('post', $post)
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
    //    return redirect()->route('posts.index')->with('message', 'Pomyślnie usunięto post!'); ;
    }

    public function search(Request $request)
    {
        $posts = Post::where('title', 'LIKE', '%'. $request->search_name .'%')
            ->orWhere('content', 'LIKE', '%'. $request->search_name .'%')->paginate(10);
        return back()->with('posts', $posts);
    }

    public function myTopics(Request $request)
    {
        if($request->ajax()) {
            return response()->json(['posts' => Post::where('user_id', Auth::user()->id)->get()]);
        }
        return view('sections.my_topics');
    }

    public function myAnswers()
    {
        $posts = Post::whereHas('comments', function (Builder $query) {
            $query->where('user_id', Auth::user()->id);
        })->get();

        return view('sections.my_answers')
            ->with('posts', $posts);
    }

    // znajdz posty ktore zawieraja moje komentarze

    // $comments = DB::table()
}
