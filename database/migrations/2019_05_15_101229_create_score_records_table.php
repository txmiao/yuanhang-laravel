<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScoreRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('score_records', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedTinyInteger('type')->comment('积分类型：100=信用积分,101=金积分,102=银积分');
            $table->string('origin_event')->comment('来源于事件：invitation=邀请, register=新用户注册, bind_phone=绑定手机号, sign_in=签到, deduct=购买商品抵扣,changed=积分商城兑换');
            $table->integer('number')->comment('数量，增减');
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
        Schema::dropIfExists('score_records');
    }
}
