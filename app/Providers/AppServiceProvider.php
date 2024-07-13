<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        view()->composer('*', function ($view) {
            $cat_home = Category::orderBy('cat_name', 'ASC')->where('status', 1)->get();
            $view->with(compact('cat_home'));
        });
    }
}
