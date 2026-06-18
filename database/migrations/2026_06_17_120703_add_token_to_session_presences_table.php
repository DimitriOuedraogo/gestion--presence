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
        Schema::table('session_presences', function (Blueprint $table) {
            $table->string('token')->unique()->nullable()->after('point_presence_id');
            $table->string('qr_code_chemin')->nullable()->after('token');
        });
    }

    public function down(): void
    {
        Schema::table('session_presences', function (Blueprint $table) {
            $table->dropUnique(['token']);
            $table->dropColumn(['token', 'qr_code_chemin']);
        });
    }
};
