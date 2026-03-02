<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
{
    Schema::create('vehicle', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->nullable()->constrained('users');
        $table->string('brand', 50)->nullable();
        $table->string('model', 50)->nullable();
        $table->integer('year')->nullable();
        $table->string('vin', 50)->nullable();
        $table->string('license_plate', 50)->nullable();
        $table->integer('mileage')->nullable();
    });
}

public function down()
{
    Schema::dropIfExists('vehicle');
}
};
