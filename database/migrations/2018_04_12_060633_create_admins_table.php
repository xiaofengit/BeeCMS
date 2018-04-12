<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email', 50)->unique()->comment('邮箱');
            $table->string('password')->comment('密码');
            $table->string('name', 50)->comment('姓名');
            $table->unsignedTinyInteger('is_active')->default(1)->comment('状态，0：禁用、1：启用');
            $table->unsignedTinyInteger('is_super')->default(0)->comment('超级管理员，0：否、1：是');
            $table->rememberToken()->comment('记住我');
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
        Schema::dropIfExists('admins');
    }
}
