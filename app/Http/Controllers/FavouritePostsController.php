<?php

namespace App\Http\Controllers;

use App\Http\Requests\FavouritePostRequest;
use App\Models\FavouritePost;
use Illuminate\Http\Request;
use App\Models\Post;
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
        // return ['posts' => FavouritePost::myFavouritePosts()];
    }

    public function getPosts()
    {
        // return FavouritePost::myFavouritePosts()->pluck('post_id');
        return response()->json(['posts' => Post::whereIn('id', FavouritePost::myFavouritePosts()->pluck('post_id'))->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FavouritePostRequest $request, FavouritePost $favouritePost)
    {
        if($favouritePost->checkIfExists($request->post_id)) { // create
            FavouritePost::where('post_id', $request->post_id)->where('user_id', $request->user_id)->delete();
            $message = "Pomyślnie usunięto z ulubionych.";
        }
        else { // delete
            FavouritePost::create($request->all());
            $message = "Pomyślnie dodano do ulubionych.";
        }
        return response()->json(['success' => $message]);

    }

    public function delete(Request $request)
    {
        // return $request;
    //    return FavouritePost::where('user_id', $request->user_id)->where('post_id', $request->post_id)->get();

    }
}
