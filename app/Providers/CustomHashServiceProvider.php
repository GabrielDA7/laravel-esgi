<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Libs\CustomHasher as CustomHasher;

class CustomHashServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
      $this->app->singleton('customHash', function () {
        return new CustomHasher;
      });
    }
}
