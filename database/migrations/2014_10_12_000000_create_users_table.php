<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->nullable();
            $table->string('phone');
            $table->string('photo')->nullable();
            $table->string('email')->unique()->nullable();
            $table->date('birthday')->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->float('review_rating')->default(0)->comment('Общий рейтинг пользователя на основе отзывов');
            $table->integer('review_total')->default(0)->comment('Общее количество отзывов');
            $table->string('phone_verification_code')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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
};
