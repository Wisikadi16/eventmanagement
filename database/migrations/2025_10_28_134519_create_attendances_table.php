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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            // user_id dari peserta yang discan
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // Kolom opsional untuk data scan
            $table->string('barcode_data')->nullable(); 

            // Waktu check-in
            $table->timestamp('checked_in_at')->useCurrent();
            
            // Kolom untuk ID staff/organizer yang melakukan scan
            $table->foreignId('scanned_by')->nullable()->constrained('users')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
