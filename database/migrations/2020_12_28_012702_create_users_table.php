<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
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
            $table->string('api_key', 64)->unique();
            $table->string('api_secret');
            $table->string('method_access', 255);
            $table->date('start');
            $table->date('end');
            $table->mediumInteger('quota')->default(0);
            $table->mediumInteger('requests')->default(0);
            $table->integer('lifetime_requests')->default(0);
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
        Schema::dropIfExists('users');
    }
}
