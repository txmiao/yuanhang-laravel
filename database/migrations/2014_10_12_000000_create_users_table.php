<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedTinyInteger('type')->default(100)->comment('用户类型：100=普通用户,101=合伙人用户');
            $table->unsignedTinyInteger('partner_level_id')->nullable()->comment('合伙人等级ID');
            $table->string('name')->unique()->comment('用户名');
            $table->string('password')->default('');
            $table->string('nickname')->default('')->comment('昵称');
            $table->string('avatar')->default('')->comment('用户头像');
            $table->string('phone')->default('')->comment('手机号');
            $table->string('real_name')->default('')->comment('真实姓名');
            $table->string('id_card')->default('')->comment('身份证号');
            $table->string('openid')->default('')->comment('微信openid');
            $table->string('unionid')->default('')->comment('微信unionid');
            $table->string('uuid')->default('')->comment('设备唯一ID');
            $table->string('invitation_code')->default('')->comment('邀请码');
            $table->unsignedInteger('inviter_id')->nullable()->comment('邀请人ID');
            $table->unsignedMediumInteger('notification_count')->default(0)->comment('未读消息数');
            $table->unsignedInteger('credit_score')->default(0)->comment('信用积分');
            $table->unsignedInteger('gold_score')->default(0)->comment('金积分');
            $table->unsignedInteger('silver_score')->default(0)->comment('银积分');
            $table->decimal('coupons_total', 10, 2)->default(0)->comment('代金券总额');
            $table->timestamp('last_actived_at')->nullable()->comment('最后登录时间');
            $table->string('last_actived_ip')->default('')->comment('最后登录ip');
            $table->unsignedTinyInteger('is_auth')->default(100)->comment('认证状态：100=未认证,101=已认证');
            $table->rememberToken();
            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
}
