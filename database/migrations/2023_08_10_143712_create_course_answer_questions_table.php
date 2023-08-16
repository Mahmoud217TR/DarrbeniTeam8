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
        Schema::create('course_answer_questions', function (Blueprint $table) {
            $table->uuid('uuid')->unique();
            $table->id();
    
            $table->foreignId('course_answer_id')->constrained('course_answers')->cascadeOnDelete();
    
            $table->foreignId('course_question_id')->constrained('course_questions')->cascadeOnDelete();
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('course_answer_questions');
    }
};
