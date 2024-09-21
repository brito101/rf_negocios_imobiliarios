<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('cover')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        DB::table('experiences')->insert([
            [
                'name' => 'Casa',
                'cover' => '/img/experiences/casa.webp',
                'created_at' => new \DateTime('now'),
            ],
            [
                'name' => 'Terreno',
                'cover' => '/img/experiences/terreno.webp',
                'created_at' => new \DateTime('now'),
            ],
            [
                'name' => 'Apartamento Padrão',
                'cover' => '/img/experiences/apartamento.webp',
                'created_at' => new \DateTime('now'),
            ],
            [
                'name' => 'Cobertura',
                'cover' => '/img/experiences/cobertura.webp',
                'created_at' => new \DateTime('now'),
            ],
            [
                'name' => 'Alto Padrão',
                'cover' => '/img/experiences/alto.webp',
                'created_at' => new \DateTime('now'),
            ],
            [
                'name' => 'De frente para o Mar',
                'cover' => '/img/experiences/mar.webp',
                'created_at' => new \DateTime('now'),
            ],
            [
                'name' => 'Condomínio Fechado',
                'cover' => '/img/experiences/condominio.webp',
                'created_at' => new \DateTime('now'),
            ],
            [
                'name' => 'Compacto',
                'cover' => '/img/experiences/compacto.webp',
                'created_at' => new \DateTime('now'),
            ],
            [
                'name' => 'Lojas e Salas',
                'cover' => '/img/experiences/comercial.webp',
                'created_at' => new \DateTime('now'),
            ],
        ]);

        DB::statement('
        CREATE OR REPLACE VIEW `experiences_view` AS
        SELECT e.id, e.name, e.cover
        FROM experiences as e
        WHERE e.deleted_at IS NULL
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experiences');
        DB::statement('DROP VIEW experiences_view');
    }
};
