<?php

namespace Noking50\Modules\BannerCarousel\Controllers;

use Noking50\Modules\Required\Controllers\BaseController;
use Noking50\Modules\BannerCarousel\Services\OutputService;
use Route;

class ModuleBannerCarouselController extends BaseController {

    protected $outputService;
    protected $group;

    public function __construct(OutputService $outputService) {
        parent::__construct();
        $this->setResponse('module_banner_carousel');

        $this->outputService = $outputService;
        $this->group = Route::current()->getAction('module_banner_carousel_group') ?: '';
    }

    public function index() {
        $output = $this->outputService->getBackendList($this->group);

        $this->response->with($output);
        return $this->response;
    }

    public function add() {
        $output = $this->outputService->getBackendAdd($this->group);

        $this->response->with($output);
        return $this->response;
    }

    public function edit() {
        $output = $this->outputService->getBackendEdit($this->group);

        $this->response->with($output);
        return $this->response;
    }

    public function detail() {
        $output = $this->outputService->getBackendDetail($this->group);

        $this->response->with($output);
        return $this->response;
    }

    ##

    public function ajax_add() {
        $output = $this->outputService->getBackendAddSubmit($this->group);

        $this->response = array_merge($this->response, $output);
        return $this->response;
    }

    public function ajax_edit() {
        $output = $this->outputService->getBackendEditSubmit($this->group);

        $this->response = array_merge($this->response, $output);
        return $this->response;
    }

    public function ajax_status() {
        $output = $this->outputService->getBackendStatus($this->group);

        $this->response = array_merge($this->response, $output);
        return $this->response;
    }

    public function ajax_delete() {
        $output = $this->outputService->getBackendDelete($this->group);

        $this->response = array_merge($this->response, $output);
        return $this->response;
    }

}
