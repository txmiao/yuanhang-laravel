<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesReturnRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_return_records', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('store_type')->comment('店铺类型：合伙人商品/专卖店/社区店/厂家直营店');
            $table->unsignedInteger('store_id')->comment('店铺ID');
            $table->unsignedInteger('order_id');
            $table->unsignedTinyInteger('status')->default(100)->comment('审核状态：100=待审核,101=已通过,102=已拒绝');
            $table->string('remark')->comment('退货申请理由');
            $table->string('refuse_reason')->default('')->comment('审核拒绝理由');
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
        Schema::dropIfExists('sales_return_records');
    }
}
