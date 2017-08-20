<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id', 10);
            $table->integer('theme_id', 10)->comment('ID темы');
            $table->string('name', 100)->comment('Заголовок вопроса');
            $table->string('text', 3000)->comment('Текст вопроса');
            $table->integer('user_id', 10)->comment('ID автора');
            $table->string('moderate', 30)->default('moderate')->comment('Стадия модерации confim / reject / moderate');
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
