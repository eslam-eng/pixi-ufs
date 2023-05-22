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
        Schema::create('awbs', function (Blueprint $table) {
            $table->id();
//            $table->bigInteger('code');
//            $table->foreignIdFor(\App\Models\Branch::class)->constrained();
//            $table->foreignIdFor(\App\Models\Department::class)->constrained();
//            $table->foreignIdFor(\App\Models\Receiver::class)->constrained();
//            $table->foreignIdFor(\App\Models\AwbServiceType::class)->constrained();
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
