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
        Schema::create('company_shipment_types', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Company::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('name');
            $table->float('fixed_weight')->nullable();
            $table->boolean('has_dimension')->default(\App\Enums\ActivationStatus::INACTIVE());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_shipment_types');
    }
};
