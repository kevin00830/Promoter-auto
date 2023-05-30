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
            $table->string('mobile_number')->unique()->nullable();
            $table->string('email')->unique();
            $table->string('fullname')->nullable();
            $table->string('firstname')->nullable();
            $table->string('username')->unique()->nullable();
            $table->string('password');
            $table->string('role')->comment('masteradmin, groupadmin, user');
            $table->unsignedBigInteger('group_id')->nullable();
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
            $table->rememberToken();
            $table->date('dob')->nullable();
            $table->date('last_login')->nullable();
            $table->string('picture')->nullable();
            $table->boolean('opt_out')->nullable();
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
