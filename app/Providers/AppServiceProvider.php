<?php

namespace App\Providers;

use App\main_menu;
use Illuminate\Support\ServiceProvider;
use App\ProductTypes;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // view()->composer('users.layout', function ($view1) {
        //     $menu=main_menu::all();
        //     $view1->with('menu',$menu);
        // });

        view()->composer('users.layout', function ($view) {
            $Phone = DB::table('tbl_category_product')->select('*')
                ->get();

            $view->with('Phone', $Phone);
        });
    }
}
