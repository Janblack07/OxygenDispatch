<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('inventory_movements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedTinyInteger('type');
            $table->dateTime('occurred_at');

            $table->uuid('tank_unit_id');
            $table->foreign('tank_unit_id')->references('id')->on('tank_units')->cascadeOnDelete();

            $table->foreignId('from_area_id')->nullable()->constrained('warehouse_areas');
            $table->foreignId('to_area_id')->nullable()->constrained('warehouse_areas');

            $table->foreignId('batch_id')->nullable()->constrained('batches')->nullOnDelete();

            $table->string('reference_document', 150)->nullable();
            $table->string('performed_by_user_email', 150);
            $table->string('notes', 500)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory_movements');
    }
};
