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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('ceo')->nullable();
            $table->string('phone');
            $table->boolean('show_dashboard')->default(\App\Enums\ActivationStatus::INACTIVE->value);
            $table->string('notes')->nullable();
            $table->boolean('status')->default(\App\Enums\ActivationStatus::ACTIVE->value);
            $table->boolean('store_receivers')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
