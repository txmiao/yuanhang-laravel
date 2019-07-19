<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthenticationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authentications', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('real_name')->comment('真实姓名');
            $table->string('id_card_number')->comment('身份证号');
            $table->string('open_bank')->comment('开户行');
            $table->string('account_number')->comment('银行卡号');
            $table->string('auth_images')->comment('认证材料：身份证照片或其它,id_card_front（身份证正面照）,id_card_reverse（身份证反面照）');
            $table->unsignedTinyInteger('status')->default(100)->comment('状态：100=待审核,101=已通过,102=已拒绝');
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
        Schema::dropIfExists('authentications');
    }
}
