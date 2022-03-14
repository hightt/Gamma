<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\FavouritePost;

class PostsAjaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         $posts = Post::orderBy('created_at', 'DESC')->paginate(5);
         if($request->ajax()) {
            return response()->json(['posts' => $posts, 'favouritePosts' => FavouritePost::myFavouritePosts()]);
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Post::where('id', $request->post_id)->delete();
        return response()->json(['success' => 'Pomyślnie usunięto post.']);
    }
}
