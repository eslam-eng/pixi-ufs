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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone');
            $table->tinyInteger('status')->default(\App\Enums\ActivationStatus::ACTIVE->value);
            $table->smallInteger('type');
            $table->foreignIdFor(\App\Models\Company::class)->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->foreignIdFor(\App\Models\Department::class)->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->foreignIdFor(\App\Models\Branch::class)->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->string('device_token')->nullable();
            $table->string('address')->nullable();
            $table->foreignIdFor(\App\Models\Location::class,'city_id')->nullable()->constrained('locations')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(\App\Models\Location::class,'area_id')->nullable()->constrained('locations')->nullOnDelete()->cascadeOnUpdate();
            $table->string('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
