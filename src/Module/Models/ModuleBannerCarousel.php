<?php

namespace Noking50\Modules\BannerCarousel\Models;

use Noking50\Modules\Required\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModuleBannerCarousel extends BaseModel {

    use SoftDeletes;

    protected $guarded = [];

    public function __construct($attributes = []) {
        $this->table = config('module_banner_carousel.datatable');
        parent::__construct($attributes);
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
