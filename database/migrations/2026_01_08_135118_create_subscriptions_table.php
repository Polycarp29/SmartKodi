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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g. Free, Pro, Enterprise
            $table->uuid('uuid');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->string('interval')->default('monthly'); // monthly, yearly, etc.
            $table->integer('duration_in_days')->nullable(); // e.g. 30 for monthly
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
