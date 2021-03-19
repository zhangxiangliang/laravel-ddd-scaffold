<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            // 索引相关
            $table->bigIncrements('id')->comment('索引: 主键');
            $table->string('mobile')->unique()->comment('索引: 手机');
            $table->string('openid')->unique()->comment('索引: OpenId');

            // 属性相关
            $table->string('avatar')->comment('属性: 头像');
            $table->string('password')->comment('属性: 密码');
            $table->string('username')->comment('属性: 用户名');
            $table->string('session_key')->comment('属性: Session Key');

            // 时间相关
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
