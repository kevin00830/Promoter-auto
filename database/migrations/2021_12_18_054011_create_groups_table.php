<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('groupname');
            $table->enum('status', ['active', 'attention', 'canceled', 'demo', 'new'])->default('new');
            $table->string('company');
            $table->unsignedInteger('country_id')->nullable();
            $table->foreign('country_id')->references('id')->on('countries');
            $table->string('wpp_group_id');
            $table->string('state');
            $table->string('city');
            $table->string('district');
            $table->string('address');
            $table->string('zipcode');
            $table->string('legal_name');
            $table->string('legal_id');
            $table->unsignedBigInteger('plan')->nullable();
            $table->foreign('plan')->references('id')->on('group_plans');
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
        Schema::dropIfExists('groups');
    }
}
