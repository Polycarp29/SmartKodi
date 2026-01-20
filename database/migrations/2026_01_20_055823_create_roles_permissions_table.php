<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\SystemConfigurations\Authorizations\Roles;
use App\Models\SystemConfigurations\Authorizations\Permissions;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles_permissions', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();

            // Explicitly include the foreign keys for Roles and Permissions
            $table->foreignIdFor(Permissions::class);
            $table->foreignIdFor(Roles::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles_permissions');
    }
};
