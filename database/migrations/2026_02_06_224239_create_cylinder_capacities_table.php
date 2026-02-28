<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cylinder_capacities', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120)->unique();
            $table->decimal('m3', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cylinder_capacities');
    }
};
