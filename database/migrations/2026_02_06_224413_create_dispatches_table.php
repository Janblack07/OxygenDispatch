<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('dispatches', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignId('client_id')->nullable()->constrained('clients')->nullOnDelete();

            $table->dateTime('dispatched_at');
            $table->string('document_number', 100)->nullable();

            $table->unsignedTinyInteger('entity_type')->nullable(); // 1/2
            $table->string('remission_plate', 50)->nullable();

            $table->string('performed_by_user_email', 150);

            $table->string('voucher_type', 50)->nullable();
            $table->string('voucher_number', 100)->nullable();
            $table->string('remission_number', 100)->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dispatches');
    }
};
