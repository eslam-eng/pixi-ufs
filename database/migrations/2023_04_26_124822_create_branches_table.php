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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignIdFor(\App\Models\Company::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('phone')->nullable();
            $table->boolean('status')->default(\App\Enums\ActivationStatus::ACTIVE());
            $table->string('address');
            $table->foreignIdFor(\App\Models\Location::class,'city_id')->constrained('locations');
            $table->foreignIdFor(\App\Models\Location::class,'area_id')->constrained('locations');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
