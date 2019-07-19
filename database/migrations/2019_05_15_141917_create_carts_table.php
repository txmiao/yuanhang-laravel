<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('store_type')->comment('店铺类型(多态关联):合伙人商城、专卖店、社区店、厂家直营店');
            $table->unsignedInteger('store_id')->comment('店铺ID');
            $table->string('goods_type')->comment('店铺类型(多态关联):合伙人商城、专卖店、社区店、厂家直营店');
            $table->unsignedInteger('goods_id')->comment('商品ID');
            $table->unsignedInteger('number')->comment('购买数量');
            $table->decimal('total_price')->comment('合计总价');
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
        Schema::dropIfExists('carts');
    }
}
