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
            $table->string('system_id')->unique();

            $table->bigInteger('role_id');
            $table->bigInteger('institute_id')->nullable();
            
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('birth_certificate')->nullable();
            $table->string('nid')->nullable();
            $table->string('password');


            $table->string('name')->nullable();
            $table->string('image')->nullable();

            $table->integer('status')->default(0)->comment('0=>Inactive, 1=> Active, 2=> Banned, 3=>Suspended');
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
            $table->rememberToken();
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
