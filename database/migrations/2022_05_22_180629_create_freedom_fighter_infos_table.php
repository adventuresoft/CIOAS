<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreedomFighterInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('freedom_fighter_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->boolean('is_freedom_fighter')->default(false);
            $table->bigInteger('type_id')->nullable();
            $table->bigInteger('area_id')->nullable();
            $table->bigInteger('designation_id')->nullable();
            $table->string('freedom_fighter_id')->nullable();
            $table->string('commander_name')->nullable();
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
        Schema::dropIfExists('freedom_fighter_infos');
    }
}
