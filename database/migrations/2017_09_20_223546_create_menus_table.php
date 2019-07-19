<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->unique()->comment('资源名称');
            $table->string('link', 100)->comment('资源链接');
            $table->string('permission', 100)->comment('资源权限');
            $table->integer('pid')->unsigned()->default(0)->comment('父级资源ID');
            $table->string('icon', 32)->default('')->comment('资源图标');
            $table->smallInteger('sort')->unsigned()->default(0)->comment('资源排序');
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
        Schema::dropIfExists('menus');
    }
}
