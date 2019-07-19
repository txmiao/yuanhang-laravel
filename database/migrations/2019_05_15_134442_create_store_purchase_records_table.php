<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStorePurchaseRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_purchase_records', function (Blueprint $table) {
            $table->increments('id');
            $table->string('store_type')->comment('店铺类型(多态关联):伙伴人商城/专卖店/厂家直营店/社区店');
            $table->unsignedInteger('store_id')->comment('店铺ID');
            $table->string('name')->comment('商品名称');
            $table->string('subtitle')->default('')->comment('商品副标题');
            $table->string('sku_number')->comment('商品编号');
            $table->string('thumbnail')->comment('商品缩略图');
            $table->text('images')->comment('商品相册');
            $table->text('detail')->comment('商品属性，[{key:xx,value:xx}');
            $table->text('detail_ext')->comment('富文本详情');
            $table->decimal('price', 10, 2)->comment('进货价');
            $table->unsignedInteger('number')->comment('数量');
            $table->unsignedTinyInteger('status')->default(100)->comment('状态：100=待确认,101=已确认');
            $table->unsignedInteger('admin_id')->nullable()->comment('操作管理员ID');
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
        Schema::dropIfExists('store_purchase_records');
    }
}
