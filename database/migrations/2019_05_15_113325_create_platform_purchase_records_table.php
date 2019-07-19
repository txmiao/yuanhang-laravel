<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlatformPurchaseRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('platform_purchase_records', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_number')->comment('订单编号');
            $table->unsignedTinyInteger('type')->comment('类型：100=合伙人商城商品,101=其它平台商品');
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
        Schema::dropIfExists('platform_purchase_records');
    }
}
