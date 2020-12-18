<?php

namespace App\Providers;

use Acme\PriceTracker\PriceTracker;
use App\Nova\Cards\Latestposts;
use Beyondcode\Viewcache\Viewcache;
use Beyondcode\NovaClock\NovaClock;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

use App\Nova\Metrics\PostCount;
use App\Nova\Metrics\PostsPerDay;
use App\Nova\Metrics\PostsPerCategory;
use Illuminate\Support\Facades\App;
use LaracastNova\UpdateOrder\UpdateOrder;

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
            new Latestposts,
            // new Help,
            // (new NovaClock)->displaySeconds(true)->blink(true),
            // (new PostsPerDay)->width('full'),
            // (new PostCount)->width('1/2'),         
            // (new PostsPerCategory)->width('1/2'),
             
            // (new \Mako\CustomTableCard\CustomTableCard)
            // ->header([
            //     new \Mako\CustomTableCard\Table\Cell('Post ID'),
            //     (new \Mako\CustomTableCard\Table\Cell('Post Text'))->class('text-left'),
            // ])
            // ->data([
            //     (new \Mako\CustomTableCard\Table\Row(
            //         new \Mako\CustomTableCard\Table\Cell('1'),
            //         (new \Mako\CustomTableCard\Table\Cell('this is a post'))->class('text-left')->id('price-2')
            //     ))->viewLink('nova/resources/posts/1'),
            //     (new \Mako\CustomTableCard\Table\Row(
            //         new \Mako\CustomTableCard\Table\Cell('2'),
            //         (new \Mako\CustomTableCard\Table\Cell('this is a second post'))->class('text-left')->id('price-2')
            //     )),
            // ])
            // ->title('Posts')
            // ->viewall(['label' => 'View All', 'link' => '/nova/resources/posts']),
            
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
            new PriceTracker(),
            new UpdateOrder(),
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
