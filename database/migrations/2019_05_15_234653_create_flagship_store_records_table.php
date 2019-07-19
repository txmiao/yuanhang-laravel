<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlagshipStoreRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flagship_store_records', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedTinyInteger('level')->comment('级别：100=省级,101=市级,102=区级');
            $table->unsignedInteger('store_id')->nullable()->comment('店铺ID');
            $table->decimal('participation_fee', 10, 2)->default(0)->comment('加盟费，根据注册人数浮动变化');
            $table->unsignedMediumInteger('parent_code')->comment('上级地区代码');
            $table->unsignedMediumInteger('location_code')->comment('省级代码/市级代码/区级代码，根据注册人数浮动变化');
            $table->string('location_name')->comment('地区名称');
            $table->unsignedTinyInteger('status')->default(100)->comment('状态:100=空缺中,101=审核中,102=已招募');
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
        Schema::dropIfExists('flagship_store_records');
    }
}
