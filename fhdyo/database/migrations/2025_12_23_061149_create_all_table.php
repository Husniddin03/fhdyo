<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('avatar')->nullable();
            $table->date('birthday');
            $table->string('gender');
            $table->timestamps();
        });

        Schema::create('humans', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('gender');
            $table->date('birthday');
            $table->string('phone');
            $table->string('jshshir');
            $table->string('passport_id');
            $table->string('province');
            $table->string('region');
            $table->timestamps();
        });

        Schema::create('couples', function (Blueprint $table) {
            $table->id();
            $table->foreignId('husband')->constrained('humans')->onDelete('cascade');
            $table->foreignId('wife')->constrained('humans')->onDelete('cascade');
            $table->string('husband_key');
            $table->string('wife_key');
            $table->string('status');
            $table->float('result')->default(0);
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->text('question');
            $table->timestamps();
        });

        Schema::create('couple_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('couple_id')->constrained('couples')->onDelete('cascade');
            $table->string('key');
            $table->foreignId('question_id')->constrained('questions')->onDelete('cascade');
            $table->integer('answer')->default(0); // -1, 0, 1
            $table->timestamps();
        });

        Schema::create('couple_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('couple_id')->constrained('couples')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->float('percent')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('couple_results');
        Schema::dropIfExists('couple_answers');
        Schema::dropIfExists('questions');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('couples');
        Schema::dropIfExists('humans');
        Schema::dropIfExists('user_data');
        Schema::dropIfExists('users');
    }
};
