<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYearlyIncomeCertificatesTable extends Migration
{
    public function up()
    {
        Schema::create('yearly_income_certificates', function (Blueprint $table) {

            $table->id();
            $table->string('system_id')->unique();

            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // NEW COLUMNS
            $table->decimal('monthly_income',10,2)->nullable();
            $table->decimal('yearly_income',12,2)->nullable();

            $table->double('fees', 16, 2)->default(0.00);
            $table->integer('quantity')->default(1);
            $table->double('total_amount', 16, 2)->default(0.00);

            $table->bigInteger('created_by');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('yearly_income_certificates');
    }
}