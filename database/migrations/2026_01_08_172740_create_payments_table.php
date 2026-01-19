<?php

use App\Models\User;
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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->foreignIdFor(User::class);
            $table->string('payment_date');
            $table->decimal('amount', 10, 2);
            $table->enum('method', ['cash', 'mpesa', 'bank_transfer', 'card', 'cheque']);
            $table->enum('status', ['completed', 'pending', 'failed']);
            $table->text('notes');
            $table->string('transaction_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
