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
        Schema::create('property_differentials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('differential_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_differentials');
    }
};
