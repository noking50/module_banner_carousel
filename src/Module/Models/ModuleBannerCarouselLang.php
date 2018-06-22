<?php

namespace Noking50\Modules\BannerCarousel\Models;

use Noking50\Modules\Required\Models\BaseModel;

class ModuleBannerCarouselLang extends BaseModel {

    public $timestamps = false;
    protected $guarded = [];
    
    public function __construct($attributes = []) {
        $this->table = config('module_banner_carousel.datatable') . '_lang';
        parent::__construct($attributes);
    }
}
