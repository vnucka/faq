<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name')->comment('Имя пользователя');
            $table->string('email')->unique()->comment('email / логин');
            $table->string('password')->comment('Пароль');
            $table->string('role', 30)->default('user')->comment('Роль пользователя admin / moderator / user');
            $table->rememberToken();
            $table->timestamps('created_at')->comment('Дата - время создания');
            $table->timestamps('updated_at')->comment('Дата - время обновления');
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
