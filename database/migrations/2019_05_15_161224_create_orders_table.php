<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_order_id')->nullable()->default(0)->comment('父级订单id');
            $table->boolean('is_main')->default(0)->comment('是否主订单 0非主订单  1主订单');
            $table->unsignedInteger('user_id');
            $table->string('store_type')->nullable()->comment('店铺类型：合伙人商品/专卖店/社区店/厂家直营店');
            $table->unsignedInteger('store_id')->nullable()->comment('店铺ID');
            $table->unsignedInteger('address_id')->comment('收货地址ID');
            $table->string('order_number')->comment('订单编号');
            $table->decimal('order_money')->comment('订单金额');
            $table->decimal('deal_money')->comment('应付金额');
            $table->decimal('pay_money')->default(0)->comment('支付金额');
            $table->unsignedInteger('deal_credit_score')->default(0)->comment('应付信用积分');
            $table->unsignedInteger('pay_credit_score')->default(0)->comment('支付信用积分');
            $table->unsignedInteger('deal_coupons_number')->default(0)->comment('应付代金券额度');
            $table->unsignedInteger('pay_coupons_number')->default(0)->comment('支付代金券额度');
            $table->decimal('shipping_fee')->default(0)->comment('运输费用');
            $table->unsignedTinyInteger('status')->default(100)->comment('订单状态：100=未付款,101=待发货,102=待收货,103=待评价,104=已完成,105=已取消');
            $table->unsignedTinyInteger('pay_type')->nullable()->default(100)->comment('支付类型：100=微信支付,101=支付宝,102=银联支付,103=金积分');
            $table->unsignedTinyInteger('shipping_methods')->nullable()->comment('配送方式id');
            $table->string('remark')->default('')->comment('订单备注');
            $table->timestamp('expired_at')->nullable()->comment('过期时间');
            $table->timestamp('paid_at')->nullable()->comment('支付时间');
            $table->timestamp('shipping_at')->nullable()->comment('发货时间');
            $table->timestamp('deal_done_at')->nullable()->comment('交易完成时间');
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
        Schema::dropIfExists('orders');
    }
}
