<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->increments('id', 10);
            $table->string('answer', 3000)->comment('Ответ');
            $table->integer('user_id', 10)->comment('ID пользователя ответа');
            $table->integer('question_id', 10)->comment('ID вопроса');
            $table->timestamps('created_at')->default('NOW')->comment('Дата - время создания');
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
        //
    }
}
