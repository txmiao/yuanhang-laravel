<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('consignee')->comment('收件人');
            $table->string('phone')->comment('联系人电话');
            $table->unsignedMediumInteger('province')->comment('省级代码');
            $table->unsignedMediumInteger('city')->comment('市级代码');
            $table->unsignedMediumInteger('district')->comment('区级代码');
            $table->string('detailed_address')->comment('详细地址');
            $table->string('full_address')->comment('完整地址');
            $table->unsignedTinyInteger('is_default')->default(100)->comment('是否为默认地址：100=不是,101=是');
            $table->string('remark')->default('');
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
        Schema::dropIfExists('addresses');
    }
}
