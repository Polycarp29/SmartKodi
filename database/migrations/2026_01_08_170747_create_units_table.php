<?php

use App\Models\Data\Properties;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->foreignIdFor(Properties::class);
            $table->string('unit_name');
            $table->string('floor_number');
            $table->enum('unit_size', ['single', 'bedsitter', 'studio', 'one bedroom', 'two bedroom', 'three bedroom', 'four bedroom', 'five bedroom']);
            $table->decimal('monthly_rent', 10, 2);
            $table->enum('status', ['vacant', 'occupied', 'maintainance']);
            $table->string('weter_meterno');
            $table->string('electricty_meterno');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};
