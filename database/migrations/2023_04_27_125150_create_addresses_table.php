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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->morphs('addressable');
            $table->string('address');
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('map_url')->nullable();
            $table->foreignIdFor(\App\Models\Location::class,'city_id')->constrained('locations')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Location::class,'area_id')->constrained('locations')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('postal_code')->nullable();
            $table->boolean('is_default')->default(\App\Enums\ActivationStatus::INACTIVE->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
