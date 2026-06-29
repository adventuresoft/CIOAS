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
        Schema::create('land_cases', function (Blueprint $table) {
            $table->id();
            $table->string('land_no')->nullable()->comment('Relates to land_no in lands table');
            $table->tinyInteger('has_case')->default(0)->comment('1 for yes, 0 for no');
            $table->string('case_no')->nullable();
            $table->string('court_name')->nullable();
            $table->string('case_status')->nullable();
            $table->text('comment')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('land_cases');
    }
};
