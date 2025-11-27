<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->text('question');
            $table->timestamps();
        });
        Schema::create('couples', function (Blueprint $table) {
            $table->id();

            $table->foreignId('first_user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('second_user_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->foreignId('questions_id')->nullable()->constrained('questions')->cascadeOnDelete();
            $table->double('result')->nullable();
            
            $table->timestamps();
        });
        Schema::create('data_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();

            $table->string('phone');
            $table->string('jshshir')->unique();
            $table->string('passport_id')->unique();
            $table->string('province');
            $table->string('region');

            $table->timestamps();
        });
        
        Schema::create('user_answers', function (Blueprint $table) {
            $table->id();

            $table->string('key');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('question_id')->constrained('questions')->cascadeOnDelete();

            $table->boolean('answer');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('couples');
        Schema::dropIfExists('data_users');
        Schema::dropIfExists('questions');
        Schema::dropIfExists('user_answers');
        Schema::dropIfExists('user_results');
    }
};
