<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use DB;
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
            // if (Auth::check() == 'true') {
				// View::share('_btnIcon', $_btnIcon);
            // }
        });
		// _btnIcon::creating(function ($btn,$icon) {
            // return $this->_btnIcon($btn,$icon);
        // });
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
