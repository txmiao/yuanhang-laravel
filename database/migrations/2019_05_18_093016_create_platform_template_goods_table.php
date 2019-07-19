<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlatformTemplateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('platform_template_goods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('商品名称');
            $table->string('subtitle')->default('')->comment('商品副标题');
            $table->string('sku_number')->comment('商品编号');
            $table->string('thumbnail')->comment('商品缩略图');
            $table->text('images')->comment('商品相册');
            $table->decimal('cost_price', 10, 2)->comment('进货价');
            $table->decimal('price', 10, 2)->comment('批发价');
            $table->unsignedInteger('inventory')->default(0)->comment('库存');
            $table->text('detail')->comment('商品属性，[{key:xx,value:xx}');
            $table->text('detail_ext')->comment('富文本详情');
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
        Schema::dropIfExists('platform_template_goods');
    }
}
