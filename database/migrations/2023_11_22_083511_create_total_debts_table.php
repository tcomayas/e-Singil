<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('total_debts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->bigInteger('totaldebt')->default(0);
            $table->enum('status', ['Active', 'Complete'])->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('total_debts');
    }
};
