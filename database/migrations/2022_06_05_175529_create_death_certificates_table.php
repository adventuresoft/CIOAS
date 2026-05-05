<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeathCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('death_certificates', function (Blueprint $table) {
            $table->id();
            $table->string('system_id')->unique();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->double('fees', 16, 2)->default(0.00);
            $table->integer('quantity')->default(0);
            $table->double('total_amount', 16, 2)->default(0.00);
            $table->bigInteger('taken_by')->default(1);
            $table->string('date_of_death')->nullable();
            $table->string('cause_of_death')->nullable();
            $table->text('comments')->nullable();
            $table->bigInteger('created_by');
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
        Schema::dropIfExists('death_certificates');
    }
}
