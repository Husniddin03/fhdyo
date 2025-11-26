<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {

        // Data Users jadvali
        Schema::create('data_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('phone')->nullable();
            $table->string('jshshir')->nullable();
            $table->string('passport_id')->nullable();
            $table->string('province')->nullable();
            $table->string('region')->nullable();
            $table->timestamps();
        });

        // Questions jadvali
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->text('question');
            $table->timestamps();
        });

        // User Answers jadvali
        Schema::create('user_answers', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('question_id')->constrained('questions')->onDelete('cascade');
            $table->enum('answer', ['yes', 'no']);
            $table->timestamps();
        });

        // User Results jadvali
        Schema::create('user_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_answers_id')->constrained('user_answers')->onDelete('cascade');
            $table->double('result');
            $table->timestamps();
        });

        // Unmarrieds jadvali
        Schema::create('un_marrieds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('un_married');
            $table->timestamps();
        });

        // Marrieds jadvali
        Schema::create('marrieds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('married');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('marrieds');
        Schema::dropIfExists('un_marrieds');
        Schema::dropIfExists('user_results');
        Schema::dropIfExists('user_answers');
        Schema::dropIfExists('questions');
        Schema::dropIfExists('data_users');
    }
};
