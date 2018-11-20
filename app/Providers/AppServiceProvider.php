<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use App\_Menu;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            if (Auth::check() == 'true') {				
				$_menu = _Menu::where('menu','admin')
					->whereNull('parent')
					->orderBy('judul', 'ASC')
					->get(); // get all menu data
            }else{
				$_menu = null;
			}
			View::share('_menu', $_menu);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
