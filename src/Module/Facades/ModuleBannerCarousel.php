<?php

namespace Noking50\Modules\BannerCarousel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see Noking50\User\User
 */
class ModuleBannerCarousel extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() {
        return 'module_banner_carousel';
    }

}
