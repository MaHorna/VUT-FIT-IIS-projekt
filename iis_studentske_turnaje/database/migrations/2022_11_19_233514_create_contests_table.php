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
        Schema::create('contests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tournament_id')->constrained()->onDelete('cascade');
            $table->foreignId('contestant1_id')->nullable()->constrained('contestants')->onDelete('set null');
            $table->foreignId('contestant2_id')->nullable()->constrained('contestants')->onDelete('set null');
            $table->foreignId('contest_child_id')->nullable()->constrained('contests')->onDelete('set null');
            $table->dateTime('start_date')->nullable();
            $table->integer('round');
            $table->integer('score1')->default(0);
            $table->integer('score2')->default(0);
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
        Schema::dropIfExists('contests');
    }
};
