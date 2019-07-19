<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnerGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_goods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('商品名称');
            $table->string('subtitle')->default('')->comment('商品副标题');
            $table->string('sku_number')->comment('商品编号');
            $table->decimal('price', 10, 2)->comment('商品价格');
            $table->text('pricing_schemes')->comment('价格方案：[{xxx:aaaa},{xxx:bbbb}]');
            $table->unsignedInteger('inventory')->default(0)->comment("库存");
            $table->decimal('pre_discount_price', 10, 2)->default(0)->comment('折前价');
            $table->decimal('cost_price')->comment('成本价');
            $table->string('thumbnail')->comment('商品缩略图');
            $table->text('images')->comment('商品相册');
            $table->string('service_tips_ids')->default('')->comment('服务保障说明ID');
            $table->text('detail')->comment('商品属性，[{key:xx,value:xx}');
            $table->text('detail_ext')->comment('富文本详情');
            $table->integer('partner_store_id')->comment('合伙人商城id');
            $table->unsignedTinyInteger('is_sale')->default(100)->comment('是否上架：100=上架，101=下架');
            $table->unsignedTinyInteger('is_recommend')->default(100)->comment('是否推荐：100=不推荐，101=推荐');
            $table->unsignedTinyInteger('is_hot')->default(100)->comment('是否为热销：100=不是,101=是');
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
        Schema::dropIfExists('partner_goods');
    }
}
