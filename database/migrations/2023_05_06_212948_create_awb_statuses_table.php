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
        Schema::create('awb_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('is_final')->default(\App\Enums\ActivationStatus::INACTIVE());
            $table->enum('stepper',\App\Enums\Stepper::values())->default(\App\Enums\Stepper::INCOMPANY());
            $table->enum('type',\App\Enums\AwbStatusCategory::values())->default(\App\Enums\AwbStatusCategory::AWB());
            $table->string('sms')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('awb_statuses');
    }
};
