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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->boolean('is_active')->default(false);
            $table->uuid('uuid');
            $table->string('otp')->nullable();
            $table->string('remember_token')->nullable();
            $table->timestamp('otp_expires_at')->nullable();
            $table->timestamp('last_otp_sent_at')->nullable();
            $table->timestamp('last_seen_at')->nullable();
            $table->integer('failed_logins')->nullable();
            $table->timestamp('locked_until')->nullable();
            $table->boolean('is_owner')->default(false);
            $table->string('google_id')->nullable();
            $table->string('google_token')->nullable();
            $table->string('google_refresh_token')->nullable();
            $table->enum('registered_from',['app', 'web'])->nullable();
            $table->string('device_name')->nullable();
            $table->string('facebook_id')->nullable();
            $table->string('facebook_access_token')->nullable();
            $table->string('facebook_refresh_token')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
