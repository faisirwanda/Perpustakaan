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
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('book_id', 40);
            $table->foreign('book_id')->references('id')->on('books');
            // $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
            $table->date('loan_date');
            $table->date('deadline');
            $table->date('return_date')->nullable();
            $table->integer('punishment')->nullable();
            $table->string('book_condition', 40)->nullable();
            $table->string('description', 100)->nullable();
            $table->string('comment')->nullable();
            $table->integer('rating')->nullable();
            $table->integer('count');
            $table->timestamps();
            // $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
