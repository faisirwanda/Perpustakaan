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
        Schema::create('books', function (Blueprint $table) {
            $table->string('id', 40)->primary();
            $table->unsignedInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->string('title', 100);
            $table->string('slug', 100)->nullable();
            $table->string('author', 40);
            $table->string('publisher', 40);
            $table->string('edition', 40);
            $table->integer('publication_year');
            $table->string('book_condition', 40);
            $table->string('status', 40)->default('Ada');
            $table->string('cover', 100)->nullable();
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
        Schema::dropIfExists('books');
    }
};
