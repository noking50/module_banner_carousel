<?php

namespace Noking50\Modules\BannerCarousel\Validations;

use Noking50\Modules\Required\Validation\BaseValidation;
use Noking50\FileUpload\Rules\JsonFile;

class ModuleBannerCarouselValidation extends BaseValidation {

    public function validate_add($request_data = null) {
        $rules = [
            'button_link' => ['string', 'nullable', 'max:200'],
            'status' => ['integer', 'required', 'in:0,1'],
            ##
            'lang' => ['array'],
            'lang.*.name' => ['string', 'required', 'max:100'],
            'lang.*.title' => ['string', 'nullable', 'max:100'],
            'lang.*.subtitle' => ['string', 'nullable', 'max:100'],
            'lang.*.photo' => [new JsonFile(1, 1)],
            'lang.*.photo_m' => [new JsonFile(1, 1)],
            'lang.*.button_text' => ['string', 'nullable', 'max:50'],
        ];
        $attributes = array_merge(
                trans('module_required::validation.attributes'),
                trans('module_banner_carousel::validation.attributes.module_banner_carousel')
                );

        return $this->validate($rules, $request_data, $attributes);
    }

    public function validate_edit($request_data = null) {
        $rules = [
            'id' => ['integer', 'required'],
            'button_link' => ['string', 'nullable', 'max:200'],
            'status' => ['integer', 'required', 'in:0,1'],
            ##
            'lang' => ['array'],
            'lang.*.name' => ['string', 'required', 'max:100'],
            'lang.*.title' => ['string', 'nullable', 'max:100'],
            'lang.*.subtitle' => ['string', 'nullable', 'max:100'],
            'lang.*.photo' => [new JsonFile(1, 1)],
            'lang.*.photo_m' => [new JsonFile(1, 1)],
            'lang.*.button_text' => ['string', 'nullable', 'max:50'],
        ];
        $attributes = array_merge(
                trans('module_required::validation.attributes'),
                trans('module_banner_carousel::validation.attributes.module_banner_carousel')
                );

        return $this->validate($rules, $request_data, $attributes);
    }

}
