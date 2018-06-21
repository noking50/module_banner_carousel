<?php

namespace Noking50\Modules\BannerCarousel\Models;

use Noking50\Modules\Required\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModuleBannerCarousel extends BaseModel {

    use SoftDeletes;

    protected $guarded = [];

    public function __construct() {
        parent::__construct();
        $this->table = config('module_banner_carousel.datatable');
    }
    
    /**
     * 資料分組
     * 
     * @param type $query
     * @return type
     */
    public function scopeModuleGroup($query, $group) {
        return $query->where($this->table . '.module_group', '=', $group);
    }

}
