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
        Schema::create('catalog_products', function (Blueprint $table) {
            $table->id();

            $table->string('code', 50)->unique();          // OMG-1, 00AC...
            $table->string('detail');                     // OXÍGENO MEDICINAL GAS 1 m³
            $table->foreignId('gas_type_id')->constrained('gas_types');
            $table->foreignId('capacity_id')->nullable()->constrained('cylinder_capacities');
            $table->string('sanitary_registry', 80)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalog_products');
    }
};
