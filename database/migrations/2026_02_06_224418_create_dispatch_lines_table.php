<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('dispatch_lines', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('dispatch_id');
            $table->uuid('tank_unit_id');

            $table->foreign('dispatch_id')->references('id')->on('dispatches')->cascadeOnDelete();
            $table->foreign('tank_unit_id')->references('id')->on('tank_units')->restrictOnDelete();

            $table->unique(['dispatch_id','tank_unit_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dispatch_lines');
    }
};
