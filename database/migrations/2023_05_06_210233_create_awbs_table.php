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
            $table->string('code')->nullable()->unique();
            $table->string('receiver_reference')->nullable();
            $table->string('receiver_city_id')->nullable();
            $table->string('receiver_area_id')->nullable();
            $table->foreignIdFor(\App\Models\User::class)->constrained();
            $table->foreignIdFor(\App\Models\Company::class)->constrained();
            $table->foreignIdFor(\App\Models\Branch::class)->constrained();
            $table->foreignIdFor(\App\Models\Department::class)->constrained();
            $table->foreignIdFor(\App\Models\Receiver::class)->nullable();
            $table->text('receiver_data');
            $table->integer('payment_type');
            $table->string('service_type');
            $table->boolean('is_return')->default(false);
            $table->string('shipment_type');
            $table->float('zone_price');
            $table->float('additional_kg_price');
            $table->float('collection')->nullable();
            $table->float('net_price')->virtualAs(\Illuminate\Support\Facades\DB::raw('zone_price + additional_kg_price'));
            $table->float('weight')->default(1);
            $table->float('pieces')->default(1);
            $table->string('actual_recipient')->nullable();
            $table->string('card_number')->nullable();
            $table->string('title')->nullable();
            $table->softDeletes();
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
