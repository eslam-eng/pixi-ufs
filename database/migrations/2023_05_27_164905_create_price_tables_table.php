<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_tables', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Company::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Location::class,'location_from')->constrained('locations');
            $table->foreignIdFor(\App\Models\Location::class,'location_to')->constrained('locations');
            $table->float('price');
            $table->float('basic_kg')->default(1);
            $table->float('additional_kg_price')->default(0);
            $table->float('return_price')->nullable();
            $table->float('special_price')->nullable();
            $table->unique(['company_id','location_from','location_to'],'unique_company_location_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('price_tables');
    }
};
