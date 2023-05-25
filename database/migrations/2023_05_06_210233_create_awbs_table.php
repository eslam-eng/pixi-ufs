<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('awbs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('code');
            $table->foreignIdFor(\App\Models\User::class)->constrained();
            $table->foreignIdFor(\App\Models\Branch::class)->constrained();
            $table->foreignIdFor(\App\Models\Department::class)->constrained();
            $table->foreignIdFor(\App\Models\Receiver::class);
            $table->json('receiver_data');
            $table->string('payment_type');
            $table->string('service_type');
            $table->boolean('is_return')->default(false);
            $table->string('shipment_type');
            $table->float('zone_price');
            $table->float('additional_kg_price');
            $table->float('collection')->default(0);
            $table->float('weight');
            $table->float('pieces');
            $table->float('actual_recipient');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('awbs');
    }
};
