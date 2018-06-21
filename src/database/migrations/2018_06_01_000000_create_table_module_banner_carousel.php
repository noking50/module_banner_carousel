<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableModuleBannerCarousel extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        $datatable = config('module_banner_carousel.datatable');
        $datatable_admin = config('user.group.admin.datatable');

        Schema::create($datatable, function(Blueprint $table) use ($datatable_admin) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->increments('id')->unsigned()->comment('ID');
            $table->dateTime('created_at')->comment('新增日期');
            $table->dateTime('updated_at')->comment('更新日期');
            $table->dateTime('deleted_at')->nullable()->comment('刪除日期');
            $table->integer("create_{$datatable_admin}_id")->unsigned()->nullable()->comment('新增人員');
            $table->integer("update_{$datatable_admin}_id")->unsigned()->nullable()->comment('更新人員');
            $table->char("module_group", 10)->collation('ascii_bin')->comment('資料分組');
            $table->string('button_link', 200)->comment('按鈕連結');
            $table->boolean('enable')->unsigned()->comment('狀態 0:停用 1:啟用');
            $table->boolean('publish')->unsigned()->comment('發布 0:暫存 1:發布');
            $table->integer('order')->unsigned()->comment('排序');

            $table->index("create_{$datatable_admin}_id");
            $table->index("update_{$datatable_admin}_id");
            $table->index('order');
            $table->index('module_group');
            $table->index(['status', 'publish']);
        });
        
        Schema::create("{$datatable}_lang", function(Blueprint $table) use ($datatable) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->integer("{$datatable}_id")->unsigned()->comment('父表ID');
            $table->char("lang", 6)->collation('ascii_bin')->comment('語言');
            $table->string('name', 100)->comment('名稱');
            $table->string('title', 100)->comment('大標題');
            $table->string('subtitle', 100)->comment('副標題');
            $table->longText('photo')->comment('PC圖片 json格式');
            $table->longText('photo_m')->comment('手機圖片 json格式');
            $table->string('button_text', 50)->comment('按鈕文字');

            $table->primary(["{$datatable}_id", 'lang']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        $datatable = config('module_banner_carousel.datatable');
        
        Schema::dropIfExists($datatable);
        Schema::dropIfExists("{$datatable}_lang");
    }

}
