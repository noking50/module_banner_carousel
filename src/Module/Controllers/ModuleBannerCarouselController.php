<?php

namespace Noking50\Modules\BannerCarousel\Controllers;

use Noking50\Modules\Required\Controllers\BaseController;
use Noking50\Modules\BannerCarousel\Facades\ModuleBannerCarousel;
use Route;

class ModuleBannerCarouselController extends BaseController {

    protected $group;

    public function __construct() {
        parent::__construct();
        $this->setResponse('module_banner_carousel');

        $this->group = Route::current()->getAction('module_banner_carousel_group') ?: '';
    }

    public function index() {
        $output = ModulesBannerCarousel::listBackend($this->group);

        $this->response->with($output);
        return $this->response;
    }

    public function add() {
        $output = ModulesBannerCarousel::detailBackendAdd($this->group);

        $this->response->with($output);
        return $this->response;
    }

    public function edit() {
        $output = ModulesBannerCarousel::detailBackendEdit($this->group);

        $this->response->with($output);
        return $this->response;
    }

    public function detail() {
        $output = ModulesBannerCarousel::detailBackend($this->group);

        $this->response->with($output);
        return $this->response;
    }

    ##

    public function ajax_add() {
        $output = ModulesBannerCarousel::actionAdd($this->group);

        $this->response = array_merge($this->response, $output);
        return $this->response;
    }

    public function ajax_edit() {
        $output = ModulesBannerCarousel::actionEdit($this->group);

        $this->response = array_merge($this->response, $output);
        return $this->response;
    }

    public function ajax_status() {
        $output = ModulesBannerCarousel::actionStatus($this->group);

        $this->response = array_merge($this->response, $output);
        return $this->response;
    }

    public function ajax_delete() {
        $output = ModulesBannerCarousel::actionDelete($this->group);

        $this->response = array_merge($this->response, $output);
        return $this->response;
    }

}
