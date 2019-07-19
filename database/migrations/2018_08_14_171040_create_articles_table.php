<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedSmallInteger('category_id');
            $table->string('title')->comment('文章标题');
            $table->string('thumbnail')->comment('缩略图');
            $table->text('content')->comment('文章内容');
            $table->unsignedInteger('sort')->default(0)->comment('排序');
            $table->unsignedTinyInteger('is_show')->default(101)->comment('是否展示：100=不展示，101=展示');
            $table->unsignedTinyInteger('is_top')->default(100)->comment('是否置顶：100=不置顶，101=置顶');
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
        Schema::dropIfExists('articles');
    }
}
