<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('technical_receptions', function (Blueprint $table) {
            $table->id();

            // Este campo es el número de orden/documento del lote.
            // Se relaciona lógicamente con batches.document_number.
            $table->string('document_number', 100)->unique();

            $table->dateTime('reception_date')->nullable();
            $table->string('invoice_number', 100)->nullable();
            $table->string('remission_guide_number', 100)->nullable();
            $table->string('supplier_name', 200)->nullable();
            $table->string('manufacturer_name', 200)->nullable();
            $table->string('delivered_by', 200)->nullable();
            $table->string('received_by', 200)->nullable();
            $table->text('storage_conditions')->nullable();
            $table->unsignedInteger('quantity_received')->default(0);

            // Cumplimiento documental general.
            $table->boolean('documentation_complies')->nullable();

            // pendiente, aprobado, rechazado
            $table->string('final_result', 20)->default('pendiente');

            $table->string('responsible_name', 200)->nullable();
            $table->string('responsible_position', 200)->nullable();
            $table->text('responsible_observation')->nullable();

            $table->string('created_by_user_email', 150)->nullable();

            $table->timestamps();

            $table->index(['document_number', 'final_result']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('technical_receptions');
    }
};
