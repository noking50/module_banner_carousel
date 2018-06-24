<?php

namespace Noking50\Modules\BannerCarousel\Repositories;

use Noking50\Modules\BannerCarousel\Models\ModuleBannerCarousel;

class ModuleBannerCarouselRepository {

    protected $moduleBannerCarousel;
    protected $table;

    public function __construct(ModuleBannerCarousel $moduleBannerCarousel) {
        $this->moduleBannerCarousel = $moduleBannerCarousel;
        $this->table = $this->moduleBannerCarousel->getTable();
    }

    # List

    public function listBackend($group, $lang = null, $sorts = null) {
        $dataSet = $this->moduleBannerCarousel->select([
                    "{$this->table}.id",
                    "{$this->table}.created_at",
                    "{$this->table}.status",
                ])
                ->translate([
                    'name'
                        ], $lang)
                ->moduleGroup($group)
                ->setSort([
                    ["{$this->table}.order", 'desc'],
                    ["{$this->table}.id", 'desc'],
                ])
                ->setPagination()
                ->get();

        return $dataSet;
    }

    public function listFrontend($group, $lang = null, $sorts = null) {
        $take = intval(config('module_banner_carousel.banner_count', 0));
        $query = $this->moduleBannerCarousel->select([
                    "{$this->table}.id",
                ])
                ->translate([
                    'title',
                    'subtitle',
                    'photo',
                    'photo_m',
                    'button_text',
                        ], $lang)
                ->moduleGroup($group)
                ->active()
                ->setSort([
            ["{$this->table}.order", 'desc'],
            ["{$this->table}.id", 'desc'],
        ]);
        if ($take > 0) {
            $query->take($take);
        }
        $dataSet = $query->get();

        return $dataSet;
    }

    public function listOrder($group, $lang = null) {
        $query = $this->moduleBannerCarousel->select([
                    "{$this->table}.id",
                ])
                ->translate([
                    'name'
                        ], $lang)
                ->moduleGroup($group)
                ->setSort([
            ["{$this->table}.order", 'desc'],
            ["{$this->table}.id", 'desc'],
        ]);
        $dataSet = $query->get();

        return $dataSet;
    }

    # Detail

    public function detail($id, $group, $columns = ['*']) {
        return $this->moduleBannerCarousel
                        ->where("{$this->table}.id", '=', $id)
                        ->moduleGroup($group)
                        ->first($columns);
    }

    public function detailWithTrashed($id, $group, $columns = ['*']) {
        return $this->moduleBannerCarousel->withTrashed()
                        ->where("{$this->table}.id", '=', $id)
                        ->moduleGroup($group)
                        ->first($columns);
    }

    public function detailBackend($id, $group) {
        $dataRow = $this->moduleBannerCarousel->select([
                    "{$this->table}.id",
                    "{$this->table}.created_at",
                    "{$this->table}.updated_at",
                    "{$this->table}.button_link",
                    "{$this->table}.status",
                ])
                ->selectUpdaterAdmin()
                ->where("{$this->table}.id", '=', $id)
                ->moduleGroup($group)
                ->first();

        return $dataRow;
    }

    public function detailBackendEdit($id, $group) {
        $dataRow = $this->moduleBannerCarousel->select([
                    "{$this->table}.id",
                    "{$this->table}.created_at",
                    "{$this->table}.updated_at",
                    "{$this->table}.button_link",
                    "{$this->table}.status",
                ])
                ->where("{$this->table}.id", '=', $id)
                ->moduleGroup($group)
                ->first();

        return $dataRow;
    }

    # others

    public function valueOrder($id, $group) {
        return $this->moduleBannerCarousel
                        ->where("{$this->table}.id", '=', $id)
                        ->moduleGroup($group)
                        ->value('order');
    }

    # insert update delete

    public function insert($data) {
        $result = $this->moduleBannerCarousel->create($data);
        if ($result) {
            $this->moduleBannerCarousel
                    ->where("{$this->table}.id", '=', $result->id)
                    ->update([
                        'order' => $result->id,
                    ]);
            $result->order = $result->id;
        }

        return $result;
    }

    public function update($id, $group, $data) {
        $before = $this->detail($id, $group);
        $result = $this->moduleBannerCarousel
                ->where("{$this->table}.id", '=', $id)
                ->moduleGroup($group)
                ->update($data);
        $after = $this->detail($id, $group);

        if ($before && $after) {
            return collect([
                'before' => $before,
                'after' => $after,
            ]);
        }
        return null;
    }

    public function delete($id, $group) {
        $before = $this->detail($id, $group);
        $result = $this->moduleBannerCarousel
                ->where("{$this->table}.id", '=', $id)
                ->whereNull("{$this->table}.deleted_at")
                ->moduleGroup($group)
                ->delete();
        $after = $this->detailWithTrashed($id, $group);

        if ($before) {
            return collect([
                'before' => $before,
                'after' => $after,
            ]);
        }
        return null;
    }

    public function order($id, $group, $order_new, $order_old) {
        $this->moduleBannerCarousel
                ->where("{$this->table}.id", '=', $id)
                ->moduleGroup($group)
                ->update([
                    'order' => $order_new,
        ]);
        $after = $this->detail($id, $group);
        if (!empty($after)) {
            $query = $this->moduleBannerCarousel
                    ->withTrashed()
                    ->where("{$this->table}.id", '!=', $id);
            if ($order_old < $order_new) {
                $query->where("{$this->table}.order", '>', $order_old)
                        ->where("{$this->table}.order", '<=', $order_new)
                        ->decrement('order');
            } else {
                $query->where("{$this->table}.order", '<', $order_old)
                        ->where("{$this->table}.order", '>=', $order_new)
                        ->increment('order');
            }
        }
    }

}
