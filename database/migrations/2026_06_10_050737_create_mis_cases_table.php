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
        Schema::create('mis_cases', function (Blueprint $table) {
            $table->id();
            $table->string('case_no')->nullable();
            $table->date('case_date');
            $table->time('case_time')->nullable();

            $table->string('case_type')->nullable();
            $table->string('case_category')->nullable();

            $table->decimal('case_fee', 12, 2)->default(0);
            $table->string('case_reason', 15, 2)->default(0);

            $table->longText('case_details')->nullable();
            $table->longText('rejection_reason')->nullable();

            $table->date('next_hearing_date')->nullable();

            $table->enum('status', [
                'draft',
                'running',
                'closed',
                'rejected'
            ])->default('draft');

            $table->json('plaintiffs')->nullable();
            $table->json('defendants')->nullable();

            $table->text('files')->nullable();

            $table->json('land_info')->nullable();

            $table->integer('create_by')->nullable();


            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mis_cases');
    }
};