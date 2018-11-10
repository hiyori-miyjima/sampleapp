<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
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
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ElasticsearchClient::class, function (Application $app) {
            $config = $app['config']->get('elasticsearch');
            return new ElasticsearchClient($config['hosts']);
        });
    }
}
