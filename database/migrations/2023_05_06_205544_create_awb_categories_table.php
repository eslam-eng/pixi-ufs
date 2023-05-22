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
        Schema::create('awb_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('has_dimension')->default(\App\Enums\ActivationStatus::ACTIVE());
            $table->float('fixed_wight')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('awb_categories');
    }
};
