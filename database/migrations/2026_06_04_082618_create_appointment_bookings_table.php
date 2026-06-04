<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointment_bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('slot_id');
            $table->unsignedBigInteger('user_id')->nullable()->comment('Citizen User ID if logged in');
            $table->unsignedBigInteger('officer_id')->comment('Officer User ID');
            $table->string('name');
            $table->date('date_of_birth')->nullable();
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('nid_number')->nullable();
            $table->text('address')->nullable();
            $table->string('purpose')->nullable();
            $table->text('description')->nullable();
            $table->string('attachment')->nullable();
            $table->enum('booking_type', ['regular', 'emergency'])->default('regular');
            $table->enum('status', ['Pending', 'Approved', 'Rejected', 'Completed', 'Cancelled', 'Expired'])->default('Pending');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment_bookings');
    }
};
