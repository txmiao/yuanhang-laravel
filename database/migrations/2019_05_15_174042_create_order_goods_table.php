<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_goods', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_id');
            $table->string('goods_type')->comment('商品类型(多态关联):合伙人商品/专卖店商品/社区店商品/直营店商品');
            $table->unsignedInteger('goods_id')->comment('对应商品ID');
            $table->string('pricing_schemes')->comment('结算方式');
            $table->unsignedInteger('number')->comment('商品数量');
            $table->decimal('subtotal', 10, 2)->comment('小计价格');
            $table->text('goods_snapshot')->comment('商品快照，用于解决交易纠纷，价格请以快照价格为准');
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
        Schema::dropIfExists('order_goods');
    }
}
