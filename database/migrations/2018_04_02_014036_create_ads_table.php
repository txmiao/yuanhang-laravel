<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('广告名称');
            $table->string('image')->comment('广告图片');
            $table->string('url')->comment('跳转链接');
            $table->unsignedInteger('sort')->default(0)->comment('排序，数值越大越靠前');
            $table->unsignedTinyInteger('status')->default(101)->comment('状态：100=关闭，101=开启');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ads');
    }
}
