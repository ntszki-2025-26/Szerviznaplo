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
    Schema::create('faults', function (Blueprint $table) {
        $table->id();
        $table->foreignId('vehicle_id')->nullable()->constrained('vehicle');
        $table->string('description', 50)->nullable();
        $table->string('category', 50)->nullable();
        $table->string('photo', 50)->nullable();
        $table->string('qr_code', 50)->nullable();
        $table->string('estimated_time', 50)->nullable();
    });
}   
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faults');
    }
};
