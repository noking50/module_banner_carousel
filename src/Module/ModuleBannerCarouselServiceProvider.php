<?php

namespace Noking50\Modules\BannerCarousel;

use Illuminate\Support\ServiceProvider;
use Noking50\Modules\BannerCarousel\Services\ControllerOutputService;

class ModuleBannerCarouselServiceProvider extends ServiceProvider {

    public function boot() {
        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'module_banner_carousel');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadViewsFrom(__DIR__.'/../views', 'module_banner_carousel');
        $this->publishes([
            __DIR__ . '/../config/module_banner_carousel.php' => config_path('module_banner_carousel.php'),
            __DIR__ . '/../lang' => resource_path('lang/vendor/module_banner_carousel'),
            __DIR__.'/../views' => base_path('resources/views/vendor/module_banner_carousel'),
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        $this->mergeConfigFrom(
                __DIR__ . '/../config/module_banner_carousel.php', 'module_banner_carousel'
        );
        $this->app->singleton('module_banner_carousel', function () {
            return new ControllerOutputService;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return ['module_banner_carousel'];
    }

}
