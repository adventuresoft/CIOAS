<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('case_orders', function (Blueprint $table) {
            $table->id();

            $table->integer('mis_case_id')->nullable();
            $table->integer('status')->nullable();
            $table->date('next_hearing_date')->nullable();
            $table->time('next_hearing_time')->nullable();
            $table->string('command_type')->nullable();
            $table->longText('command_text')->nullable();
            $table->string('side_note')->nullable();
            $table->integer('order_by')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('case_orders');
    }
};
