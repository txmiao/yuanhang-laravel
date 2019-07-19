<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('special_stores', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedTinyInteger('type')->comment('专卖店类型：100=普通店,101=旗舰店');
            $table->string('name')->comment('专卖店名称');
            $table->string('desc')->comment('店铺描述');
            $table->string('shop_logo')->comment('门店logo');
            $table->unsignedMediumInteger('province')->comment('省级代码');
            $table->unsignedMediumInteger('city')->comment('市级代码');
            $table->unsignedMediumInteger('district')->comment('区级代码');
            $table->string('detailed_address')->comment('详细地址');
            $table->string('full_address')->comment('完整地址');
            $table->string('coordinate')->default('')->comment('坐标，经纬度');
            $table->string('contact')->comment('联系人');
            $table->string('phone')->comment('联系电话：["187xxxx2345","023-23232323"]');
            $table->string('business_license')->default('')->comment('营业执照');
            $table->string('circulative_license')->default('')->comment('流通许可证');
            $table->text('shop_env_images')->nullable()->comment('门店环境图片');
            $table->string('shipping_methods')->comment('配送服务：100=送货上门,101=上门自提, [100,101]');
            $table->string('business_hours')->comment('营业时间，["07:00","21:00"]');
            $table->string('preferential_policy')->default('')->comment('优惠政策');
            $table->timestamp('expired_at')->comment('店铺到期时间');
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
        Schema::dropIfExists('special_stores');
    }
}
