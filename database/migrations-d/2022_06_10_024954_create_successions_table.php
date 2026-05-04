<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuccessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('successions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('death_certificate_id')->constrained('death_certificates')->onDelete('cascade');
            $table->json('members')->nullable();
            $table->double('fees', 16, 2)->default(0.00);
            $table->integer('quantity')->default(0);
            $table->double('total_amount', 16, 2)->default(0.00);
            $table->bigInteger('created_by');
            $table->bigInteger('taken_by')->default(1);
            $table->string('date_of_death')->nullable();
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
        Schema::dropIfExists('successions');
    }
}
