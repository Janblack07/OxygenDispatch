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
    Schema::table('tank_units', function (Blueprint $table) {
    $table->string('serial_prefix', 10)->nullable()->after('product_id');
    $table->unsignedBigInteger('serial_number')->nullable()->after('serial_prefix');
});
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tank_units', function (Blueprint $table) {
            //
        });
    }
};
