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
        Schema::create('session_presences', function (Blueprint $table) {
            $table->id();
            $table->date('date_presence')->nullable(false);
            $table->string('nom')->nullable(false);
            $table->time('heure_debut')->nullable(false);
            $table->time('heure_fin');
            $table->unsignedBigInteger('point_presence_id');
            $table->foreign('point_presence_id')->references('id')->on('point_presences')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('session_presences');
    }
};
