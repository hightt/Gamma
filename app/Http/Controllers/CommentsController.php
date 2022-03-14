<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {
        if(Auth::check()) {
            Comment::create(array_merge($request->only('content', 'post_id'), ['user_id' => Auth::user()->id]));
            return redirect()->route('posts.show', $request->post_id)->withInput();
        } else {
            return response()->json(['message' => 'Nie jesteś zalogowany']);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        Comment::destroy($comment->id);
        return back()->with('message', 'Pomyślnie usunięto komentarz!'); ;
    }
}
