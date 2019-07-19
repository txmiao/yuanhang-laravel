<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnerLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_levels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('level')->comment('等级，a->z依次升高');
            $table->string('name')->comment('等级名称');
            $table->unsignedInteger('sort')->default(0)->comment('排序，数值越大越靠前');
            $table->string('desc')->default('')->comment('描述备注');
            $table->string('sku_number')->default('')->comment('需要购买的组合商品sku，json存储，初始等级为空');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partner_levels');
    }
}
