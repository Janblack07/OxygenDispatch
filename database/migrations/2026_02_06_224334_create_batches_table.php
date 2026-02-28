<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('batches', function (Blueprint $table) {
            $table->id();
            $table->string('batch_number', 100)->unique();

            $table->foreignId('gas_type_id')->constrained('gas_types');
            $table->foreignId('capacity_id')->constrained('cylinder_capacities');

            $table->dateTime('received_at');

            $table->string('document_number', 100)->nullable();
            $table->text('notes')->nullable();

            $table->string('created_by_user_email', 150);

            $table->string('supplier_name', 200)->nullable();
            $table->string('supplier_code', 100)->nullable();
            $table->string('voucher_type', 50)->nullable();
            $table->string('voucher_number', 100)->nullable();
            $table->date('voucher_date')->nullable();

            $table->string('sanitary_registry', 100)->nullable();
            $table->date('manufactured_at')->nullable();
            $table->date('expires_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('batches');
    }
};
