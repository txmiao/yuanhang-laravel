<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlatformPurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('platform_purchase_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_number');
            $table->decimal('order_amount', 10, 2)->comment('订单金额');
            $table->string('consignee');
            $table->string('phone');
            $table->string('express_company')->default('');
            $table->string('express_number')->default('');
            $table->unsignedTinyInteger('pay_status')->default(100)->comment('支付状态：100=未支付,101=已支付');
            $table->unsignedTinyInteger('shipping_status')->default(100)->comment('发货状态：100=待发货,101=已发货');
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
        Schema::dropIfExists('platform_purchase_orders');
    }
}
