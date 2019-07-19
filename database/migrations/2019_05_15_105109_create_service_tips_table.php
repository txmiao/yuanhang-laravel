<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceTipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_tips', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('服务保障名称');
            $table->string('icon')->comment('服务保障图标');
            $table->string('content')->comment('内容描述');
            $table->unsignedTinyInteger('bind_type')->comment('绑定类型：100=全平台，101=合伙人商城,102=专卖店,103=社区店,104=厂家直营店');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_tips');
    }
}
