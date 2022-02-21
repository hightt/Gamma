<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\User;
use App\Models\Post;
class MainServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        View::share('best_users', $this->theMostActiveUsers());

        View::composer('index', function($view) {
            $view->with('posts', Post::orderBy('created_at', 'DESC')->paginate(10));
        });
    }

    public function theMostActiveUsers()
    {
        return collect(User::all())->map(function($item) {
            return [
                    'id' => $item->id,
                    'num' => User::find($item->id)->comments()->count(),
                    'user_name' => User::where('id', $item->id)->value("name")
                ];
        })->sortByDesc('num')->take(8)->values()->toArray();
    }
}
