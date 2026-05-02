<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoterListCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voter_list_certificates', function (Blueprint $table) {
            $table->id();
            $table->string('system_id')->unique();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->double('fees', 16, 2)->default(0.00);
            $table->integer('quantity')->default(1);
            $table->double('total_amount', 16, 2)->default(0.00);
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
        Schema::dropIfExists('voter_list_certificates');
    }
}
