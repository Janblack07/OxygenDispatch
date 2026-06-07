<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('technical_reception_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('technical_reception_id')
                ->constrained('technical_receptions')
                ->cascadeOnDelete();

            $table->string('section', 120);
            $table->text('label');
            $table->boolean('complies')->nullable();
            $table->text('observation')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);

            $table->timestamps();

            $table->index(['technical_reception_id', 'section']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('technical_reception_items');
    }
};
