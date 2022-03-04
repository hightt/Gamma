<?php

namespace App\Http\Controllers;

use App\Http\Requests\FavouritePostRequest;
use App\Models\FavouritePost;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
class FavouritePostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("sections.favourite_posts");
    }

    public function getPosts()
    {
        if(Auth::check()) {
            $posts = Post::whereIn('id', FavouritePost::myFavouritePosts()->pluck('post_id'))->get();
        } else {
            $posts = null;
        }
        return response()->json(['posts' => $posts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FavouritePostRequest $request, FavouritePost $favouritePost)
    {
        if($favouritePost->checkIfExists($request->post_id)) { // delete
            FavouritePost::where('post_id', $request->post_id)->where('user_id', $request->user_id)->delete();
            $message = "Pomyślnie usunięto z ulubionych.";
        }
        else { // create
            FavouritePost::create($request->all());
            $message = "Pomyślnie dodano do ulubionych.";
        }
        return response()->json(['success' => $message]);

    }
}
