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
        Schema::table('presences', function (Blueprint $table) {
            $table->string('adresse_ip', 45)->nullable()->after('appareil');
            $table->decimal('latitude', 10, 8)->nullable()->change();
            $table->decimal('longitude', 11, 8)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('presences', function (Blueprint $table) {
            $table->dropColumn('adresse_ip');
            $table->decimal('latitude', 10, 8)->nullable(false)->change();
            $table->decimal('longitude', 11, 8)->nullable(false)->change();
        });
    }
};
