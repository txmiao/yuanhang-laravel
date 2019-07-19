<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthRecordByYsePaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auth_record_by_yse_pays', function (Blueprint $table) {
            $table->increments('id');
            $table->string('out_trade_no')->comment('银盛交易订单号');
            $table->unsignedInteger('authentication_id')->comment('实名认证记录ID');
            $table->string('order_status')->default('')->comment('认证结果：success | failure');
            $table->text('request_data')->nullable()->comment('请求参数');
            $table->text('response_data')->nullable()->comment('响应参数');
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
        Schema::dropIfExists('auth_record_by_yse_pays');
    }
}
