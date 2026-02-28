<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('tank_units', function (Blueprint $table) {
            // si ya existe created_at en tu tabla, solo agrega updated_at:
            if (!Schema::hasColumn('tank_units', 'updated_at')) {
                $table->timestamp('updated_at')->nullable()->after('created_at');
            }

            // si no existe created_at, agrega ambos:
            if (!Schema::hasColumn('tank_units', 'created_at')) {
                $table->timestamp('created_at')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('tank_units', function (Blueprint $table) {
            if (Schema::hasColumn('tank_units', 'updated_at')) $table->dropColumn('updated_at');
            if (Schema::hasColumn('tank_units', 'created_at')) $table->dropColumn('created_at');
        });
    }
};
