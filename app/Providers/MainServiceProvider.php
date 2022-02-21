<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\User;

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
        $best_users = collect(User::all())->map(function($item) {
            return [
                    'id' => $item->id,
                    'num' => User::find($item->id)->comments()->count(),
                    'user_name' => User::where('id', $item->id)->value("name")
                ];
        })->sortByDesc('num')->take(8)->values()->toArray();

        View::share('best_users', $best_users);
    }
}
