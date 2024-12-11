<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 1. Tạo bảng categories
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cat_name')->unique();
            $table->string('cat_image');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });

        // 2. Tạo bảng users
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fullname', 100);
            $table->string('email', 100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 200);
            $table->string('role', 255)->nullable();
            $table->string('address', 200);
            $table->string('avatar', 500)->nullable();
            $table->string('phoneNumber', 50);
            $table->timestamps();
        });

        // 3. Tạo bảng courses
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('course_name');
            $table->unsignedInteger('category_id')->nullable();
            $table->unsignedInteger('user_id');
            $table->string('image');
            $table->string('description');
            $table->string('file', 500);
            $table->timestamps();
            $table->tinyInteger('status')->nullable();

            // Khóa ngoại
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        // 4. Tạo bảng comments
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('course_id');
            $table->string('content');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('course_id')->references('id')->on('courses');
        });

        // 5. Tạo bảng enrolls
        Schema::create('enrolls', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('course_id')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('set null');
        });

        // 6. Tạo bảng favorites
        Schema::create('favorites', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('course_id')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('set null');
        });

        // 7. Tạo bảng tests
        Schema::create('tests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('test_name');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('course_id');
            $table->integer('deadline_after')->nullable();
            $table->timestamps();
            $table->integer('test_time')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });

        // 8. Tạo bảng test_attempts
        Schema::create('test_attempts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('test_id');
            $table->string('status')->default('Taking');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('test_id')->references('id')->on('tests')->onDelete('cascade');
        });

        // 9. Tạo bảng feedbacks
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('test_attempt_id');
            $table->text('content')->nullable();
            $table->timestamps();

            $table->foreign('test_attempt_id')->references('id')->on('test_attempts')->onDelete('cascade');
        });

        // 10. Tạo bảng questions
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('question')->nullable();
            $table->string('a')->nullable();
            $table->string('b')->nullable();
            $table->string('c')->nullable();
            $table->string('d')->nullable();
            $table->string('answer')->nullable();
            $table->unsignedInteger('test_id');
            $table->timestamps();

            $table->foreign('test_id')->references('id')->on('tests')->onDelete('cascade');
        });

        // 11. Tạo bảng test_results
        Schema::create('test_results', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('question_id');
            $table->unsignedInteger('test_attempt_id');
            $table->string('selected_answer')->nullable();
            $table->tinyInteger('is_correct');
            $table->timestamps();

            $table->foreign('question_id')->references('id')->on('questions');
            $table->foreign('test_attempt_id')->references('id')->on('test_attempts')->onDelete('cascade');
        });

        // 12. Tạo bảng student_deadlines
        Schema::create('student_deadlines', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('test_id');
            $table->timestamp('deadline')->useCurrent()->onUpdate('current_timestamp');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('test_id')->references('id')->on('tests')->onDelete('cascade');
        });

        // 13. Tạo bảng user_reset_tokens
        Schema::create('user_reset_tokens', function (Blueprint $table) {
            $table->string('email');
            $table->string('token');
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
        Schema::dropIfExists('test_results');
        Schema::dropIfExists('test_attempts');
        Schema::dropIfExists('tests');
        Schema::dropIfExists('student_deadlines');
        Schema::dropIfExists('questions');
        Schema::dropIfExists('feedbacks');
        Schema::dropIfExists('favorites');
        Schema::dropIfExists('failed_jobs');
        Schema::dropIfExists('enrolls');
        Schema::dropIfExists('courses');
        Schema::dropIfExists('comments');
        Schema::dropIfExists('ch_messages');
        Schema::dropIfExists('ch_favorites');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('users');
        Schema::dropIfExists('user_reset_tokens');
    }
}
