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
        Schema::create('receivers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone1');
            $table->string('phone2')->nullable();
            $table->text('receiving_company')->nullable();
            $table->text('address1');
            $table->text('address2')->nullable();
            $table->string('receiving_branch')->nullable();
            $table->foreignIdFor(\App\Models\Company::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Branch::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Location::class,'city_id')->constrained('locations');
            $table->foreignIdFor(\App\Models\Location::class,'area_id')->constrained('locations');
            $table->string('reference')->nullable()->index();
            $table->unique(['reference','company_id'],'unique_receiver_code');
            $table->string('title')->nullable();
            $table->smallInteger('status')->default(\App\Enums\ActivationStatus::ACTIVE());
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('map_url')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receivers');
    }
};
