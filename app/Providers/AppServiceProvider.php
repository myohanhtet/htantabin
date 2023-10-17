<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
    public function boot()
    {
        if(env('APP_ENV') !== 'local') {
            URL::forceScheme('https');
        }


        Paginator::useBootstrap();
        Builder::macro("whereLike", function($attributes,string $searchTerm){
            foreach (Arr::wrap($attributes) as $attribute) {
                $this->orWhere($attribute, 'LIKE',"%{$searchTerm}%");
            }
            return $this;
        });

    }
}
