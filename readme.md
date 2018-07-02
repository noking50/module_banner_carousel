# Module Banner Carousel

banner carousel

## Installing

### 1. Install from composer
```
composer required noking50/module_banner_carousel
```

### 2. Publish resoure
```
php artisan vendor:publish
```
It would generate below files
config/module_banner_carousel.php
resources/lang/vendor/module_banner_carousel/
resources/views/vendor/module_banner_carousel/


### 3. configure file config/module_banner_carousel.php
* set data table name
```
'datatable' => 'module_banner_carousel'
```

* set each using banner page configure
```
'groups' => [
    'home' => [
        'photo_pc_scale' => '1920_800', // PC image size
        'photo_mobile_scale' => '800_250', // Mobile image size
        'banner_count' => 0, // how many image roll
    ],
    'other_banner' => [],
    ...
],
```

### 4. migration
```
php artisan migrate
```
create banner carouse database table, table name will be config file settings above

## Usage
### Package method
* list backend
```
$output = ModulesBannerCarousel::listBackend($group);
```
$output is an array contains key:
'dataSet_module_banner_carousel' - list of banner data

* list frontend
```
$output = ModulesBannerCarousel::listFrontend($group);
```
$output is an array contains key:
'dataSet_module_banner_carousel' - list of banner data

* get data detail
```
$output = ModulesBannerCarousel::detailBackend($group);
```
$output is an array contains key:
'dataRow_module_banner_carousel' - Model data from given id
'form_choose_lang' - list of all available language and indicate each language has setting value

* get required data for add page
```
$output = ModulesBannerCarousel::detailBackendAdd($group);
```
$output is an array contains key:
'form_choose_lang' - list of all available language and indicate each language has setting value
'dataSet_module_banner_carousel' - list of ordered and active banner data

* get data detail and other required data for edit page
```
$output = ModulesBannerCarousel::detailBackendEdit($group);
```
$output is an array contains key:
'dataRow_module_banner_carousel' - Model data from given id
'form_choose_lang' - list of all available language and indicate each language has setting value
'dataSet_module_banner_carousel' - list of ordered and active banner data

* add data
```
$output = ModulesBannerCarousel::actionAdd($group);
```
$output is an array contains key:
'msg' - success message

* edit data
```
$output = ModulesBannerCarousel::actionEdit($group);
```
$output is an array contains key:
'msg' - success message

* change data status
```
$output = ModulesBannerCarousel::actionStatus($group);
```
$output is an array contains key:
'msg' - success message

* delete data
```
$output = ModulesBannerCarousel::actionDelete($group);
```
$output is an array contains key:
'msg' - success message

### default controller
using a default controller in Module\Controllers\ModuleBannerCarouselController
* set Route like below
```
Route::get('/list', [
    'uses' => "\\Noking50\\Modules\\BannerCarousel\\Controllers\\ModuleBannerCarouselController@index",
    'module_banner_carousel_group' => 'home',
]);
Route::get('/add', [
    'uses' => "\\Noking50\\Modules\\BannerCarousel\\Controllers\\ModuleBannerCarouselController@add",
    'module_banner_carousel_group' => 'home',
])
```
'module_banner_carousel_group' is which group setting in config will be used

* set view
set views in resources/views/vendor/module_banner_carousel/
