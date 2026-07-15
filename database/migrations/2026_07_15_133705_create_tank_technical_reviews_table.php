<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tank_technical_reviews', function (Blueprint $table) {
            $table->id();

            $table->uuid('tank_unit_id');
            $table->foreign('tank_unit_id')
                ->references('id')
                ->on('tank_units')
                ->cascadeOnDelete();

            $table->foreignId('technical_reception_id')
                ->nullable()
                ->constrained('technical_receptions')
                ->nullOnDelete();

            // approved | rejected
            $table->string('result', 20);

            // Solo cuando existe anomalía/rechazo.
            $table->string('anomaly_type', 120)->nullable();
            $table->text('observation')->nullable();

            $table->string('reviewed_by_user_email', 150);
            $table->dateTime('reviewed_at');

            $table->timestamps();

            $table->index([
                'tank_unit_id',
                'result',
                'reviewed_at',
            ]);

            $table->index([
                'technical_reception_id',
                'result',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tank_technical_reviews');
    }
};
