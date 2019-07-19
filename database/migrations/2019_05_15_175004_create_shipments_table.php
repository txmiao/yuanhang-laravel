<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_id');
            $table->string('express_company')->default('')->comment('快递公司名称');
            $table->string('express_official_tel')->default('')->comment('快递官方电话');
            $table->string('express_number')->default('')->comment('快递快递单号');
            $table->text('logistics_information')->nullable()->comment('物流信息');
            $table->unsignedTinyInteger('status')->default(100)->comment('发货状态：100=待发货,101=已发货');
            $table->unsignedInteger('admin_id')->nullable()->comment('发货人员ID');
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
        Schema::dropIfExists('shipments');
    }
}
