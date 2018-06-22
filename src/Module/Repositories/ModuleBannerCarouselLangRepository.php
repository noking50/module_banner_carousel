<?php

namespace Noking50\Modules\BannerCarousel\Repositories;

use Noking50\Modules\BannerCarousel\Models\ModuleBannerCarouselLang;

class ModuleBannerCarouselLangRepository {

    protected $moduleBannerCarouselLang;
    protected $table;
    protected $parent_table;

    public function __construct(ModuleBannerCarouselLang $moduleBannerCarouselLang) {
        $this->moduleBannerCarouselLang = $moduleBannerCarouselLang;
        $this->table = $this->moduleBannerCarouselLang->getTable();
        $this->parent_table = config('module_banner_carousel.datatable');
    }

    # List

    public function listAll($parent_id) {
        $dataSet = $this->moduleBannerCarouselLang->select([
                    "{$this->table}.{$this->parent_table}_id",
                    "{$this->table}.lang",
                    "{$this->table}.name",
                    "{$this->table}.title",
                    "{$this->table}.subtitle",
                    "{$this->table}.photo",
                    "{$this->table}.photo_m",
                    "{$this->table}.button_text",
                ])
                ->where("{$this->table}.{$this->parent_table}_id", '=', $parent_id)
                ->orderBy("{$this->table}.lang", 'asc')
                ->get();

        return $dataSet;
    }

    # Detail

    public function detail($parent_id, $lang, $columns = ['*']) {
        $dataRow = $this->moduleBannerCarouselLang
                ->where("{$this->table}.{$this->parent_table}_id", '=', $parent_id)
                ->where("{$this->table}.lang", '=', $lang)
                ->first($columns);

        return $dataRow;
    }

    # insert update delete

    public function insert($data) {
        $result = $this->moduleBannerCarouselLang->create($data);

        return $result;
    }

    public function update($parent_id, $lang, $data) {
        $before = $this->detail($parent_id, $lang);
        $result = $this->moduleBannerCarouselLang
                ->where("{$this->table}.{$this->parent_table}_id", '=', $parent_id)
                ->where("{$this->table}.lang", '=', $lang)
                ->update($data);
        $after = $this->detail($parent_id, $lang);

        if ($before && $after) {
            return collect([
                'before' => $before,
                'after' => $after,
            ]);
        }
        return null;
    }

    public function delete($parent_id, $lang) {
        $before = $this->detail($parent_id, $lang);
        $result = $this->moduleBannerCarouselLang
                ->where("{$this->table}.{$this->parent_table}_id", '=', $parent_id)
                ->where("{$this->table}.lang", '=', $lang)
                ->delete();

        if ($before) {
            return $before;
        }
        return null;
    }

    public function deleteAll($parent_id) {
        $before = $this->moduleBannerCarouselLang
                ->where("{$this->table}.{$this->parent_table}_id", '=', $parent_id)
                ->get();
        $result = $this->moduleBannerCarouselLang
                ->where("{$this->table}.{$this->parent_table}_id", '=', $parent_id)
                ->delete();

        if (count($before) > 0) {
            return $before;
        }
        return null;
    }

}
