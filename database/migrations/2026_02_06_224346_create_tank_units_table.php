<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tank_units', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('serial', 120)->unique();

            $table->foreignId('batch_id')->constrained('batches')->cascadeOnDelete();
            $table->foreignId('gas_type_id')->constrained('gas_types');
            $table->foreignId('capacity_id')->constrained('cylinder_capacities');
            $table->foreignId('warehouse_area_id')->constrained('warehouse_areas');
            $table->foreignId('technical_status_id')->constrained('technical_statuses');

            $table->string('sanitary_registry', 100)->nullable();
            $table->date('manufactured_at')->nullable();
            $table->date('expires_at')->nullable();

            $table->unsignedTinyInteger('status')->default(1); // 1 DISPONIBLE

            $table->dateTime('created_at');
            $table->dateTime('dispatched_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tank_units');
    }
};
