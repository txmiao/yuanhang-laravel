<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shippings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->comment('运输方式编码');
            $table->string('name')->comment('运输方式名称');
            $table->boolean('is_self_pick')->default(0)->comment('是否自提');
            $table->boolean('status')->default(1)->comment('是否启用');
            $table->tinyInteger('sort')->default(0)->comment('排序');
            $table->json('config')->nullable()->comment('配置信息');
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
        Schema::dropIfExists('shippings');
    }
}
