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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            //$table->foreignId('leader_id')->onDelete('cascade');
            //$table->foreign('leader_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('user_id')->constrained();
            $table->string('name');
            $table->string('logo')->nullable();
            $table->longtext('description');
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
        Schema::dropIfExists('teams');
    }
};
