<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNameCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('name_certificates', function (Blueprint $table) {
            $table->id();
            $table->string('system_id')->unique();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            // Add these lines
    $table->string('name_english')->nullable();
    $table->string('name_bangla')->nullable();
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
        Schema::dropIfExists('name_certificates');
    }
}
