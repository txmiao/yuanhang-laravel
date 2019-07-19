<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('用户ID');
            $table->unsignedTinyInteger('type')->default(100)->comment('消息类型：100=系统消息，101=站内消息');
            $table->string('title')->comment('消息标题');
            $table->text('content')->comment('消息内容');
            $table->unsignedTinyInteger('is_read')->default(100)->comment('是否已读（100=未读，101=已读）');
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
        Schema::dropIfExists('messages');
    }
}
