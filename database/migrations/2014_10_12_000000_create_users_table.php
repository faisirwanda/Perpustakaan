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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username', 40);
            $table->string('slug', 40);
            $table->string('email', 40)->unique();
            $table->string('gender', 40);
            $table->string('address', 100);
            $table->string('class', 40)->nullable();
            $table->string('status', 40)->default('inactive');
            $table->string('password', 60);
            $table->string('photo', 100)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
