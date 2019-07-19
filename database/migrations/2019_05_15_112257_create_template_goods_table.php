<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('template_goods', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('supplier_id')->comment('供应商ID');
            $table->unsignedInteger('type')->comment('类型：100=合伙人商城商品,101=其它平台商品');
            $table->string('name')->comment('商品名称');
            $table->string('subtitle')->default('')->comment('商品副标题');
            $table->string('sku_number')->comment('商品编号');
            $table->string('thumbnail')->comment('商品缩略图');
            $table->text('images')->comment('商品相册');
            $table->decimal('price', 10, 2)->comment('进货价');
            $table->text('detail')->comment('商品属性，[{key:xx,value:xx}');
            $table->text('detail_ext')->nullable()->comment('富文本详情');
            $table->unsignedTinyInteger('is_sale')->default(100)->comment('售卖状态：100=已上架,101=已下架');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('template_goods');
    }
}
