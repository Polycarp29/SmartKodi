<?php

use App\Models\User;
use App\Models\Data\Units;
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
        Schema::create('property_tenants', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->foreignIdFor(Units::class);
            $table->foreignIdFor(User::class);
            $table->date('lease_start_date');
            $table->date('lease_end_date');
            $table->decimal('monthly_rent', 10,2);
            $table->string('security_deposit');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_tenants');
    }
};
