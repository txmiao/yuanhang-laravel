<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantsJoinApplyRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchants_join_apply_records', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedTinyInteger('type')->comment('加盟类型：100=专卖店,101=社区店,102=厂商直营店');
            $table->unsignedTinyInteger('level')->comment('申请级别，专卖店类型时有效，100=省级,101=市级,102=区级');
            $table->unsignedMediumInteger('province')->comment('省级代码');
            $table->unsignedMediumInteger('city')->comment('市级代码');
            $table->unsignedMediumInteger('district')->comment('区级代码');
            $table->string('detailed_address')->comment('详细地址');
            $table->string('full_address')->comment('完整地址');
            $table->string('coordinate')->comment('坐标，经纬度');
            $table->string('recommend_contact_phone')->default('')->comment('推荐联系人手机号');
            $table->string('contact')->comment('联系人');
            $table->string('phone')->comment('联系电话');
            $table->text('essential_material')->comment('必备资料，营业执照和流通许可证');
            $table->text('other_material')->nullable()->comment('其它资料');
            $table->unsignedTinyInteger('status')->default(100)->comment('审核状态：100=待审核,101=已通过,102=已拒绝');
            $table->string('refuse_reason')->default('')->comment('拒绝理由');
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
        Schema::dropIfExists('merchants_join_apply_records');
    }
}
