<?php

namespace App\Providers;

use Beyondcode\Viewcache\Viewcache;
use Beyondcode\NovaClock\NovaClock;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

use App\Nova\Metrics\PostCount;
use App\Nova\Metrics\PostsPerDay;
use App\Nova\Metrics\PostsPerCategory;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Get the cards that should be displayed on the default Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        return [
            // new Help,
            (new NovaClock)->displaySeconds(true)->blink(true),
            (new PostsPerDay)->width('full'),
            (new PostCount)->width('1/2'),         
            (new PostsPerCategory)->width('1/2'),
            
        ];
    }

    /**
     * Get the extra dashboards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            new Viewcache,
        ];
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

    // This is how you can manually set the resources from NovaApplicationServiceProvider to NovaServiceProvider and can
    // add our own resource.

    // protected function resources()
    // {
    //     Nova::resourcesIn(app_path('Nova'));

    //     Nova::resources([
    //         \App\Resource\User::class,
    //     ]);
    // }

}
