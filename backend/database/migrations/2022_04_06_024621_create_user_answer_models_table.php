<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_answers', function (Blueprint $table) {
            $table->bigIncrements('u_answer_id');
            $table->integer('category_id');
            $table->integer('question_id');
            $table->integer('choice_id');
            $table->integer('status_id');
            $table->integer('user_id');
            $table->timestamps();

            $table->index(['question_id', 'user_id']);
            $table->unique(['question_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_answers');
    }
};
