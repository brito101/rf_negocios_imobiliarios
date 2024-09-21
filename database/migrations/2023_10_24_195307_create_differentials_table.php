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
        Schema::create('differentials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->softDeletes();
            $table->timestamps();
        });

        DB::table('differentials')->insert([

            [
                'name' => 'Ar Condicionado',
                'created_at' => new \DateTime('now'),
            ],
            [
                'name' => 'Cozinha Planejada',
                'created_at' => new \DateTime('now'),
            ],
            [
                'name' => 'Biblioteca',
                'created_at' => new \DateTime('now'),
            ],
            [
                'name' => 'Churrasqueira',
                'created_at' => new \DateTime('now'),
            ],
            [
                'name' => 'Cozinha Americana',
                'created_at' => new \DateTime('now'),
            ],
            [
                'name' => 'Despensa',
                'created_at' => new \DateTime('now'),
            ],
            [
                'name' => 'Edícula',
                'created_at' => new \DateTime('now'),
            ],
            [
                'name' => 'Escritório',
                'created_at' => new \DateTime('now'),
            ],
            [
                'name' => 'Banheira',
                'created_at' => new \DateTime('now'),
            ],
            [
                'name' => 'Lareira',
                'created_at' => new \DateTime('now'),
            ],
            [
                'name' => 'Lavabo',
                'created_at' => new \DateTime('now'),
            ],
            [
                'name' => 'Mobiliado',
                'created_at' => new \DateTime('now'),
            ],
            [
                'name' => 'Piscina',
                'created_at' => new \DateTime('now'),
            ],
            [
                'name' => 'Sauna',
                'created_at' => new \DateTime('now'),
            ],
            [
                'name' => 'Vista para o Mar',
                'created_at' => new \DateTime('now'),
            ],
        ]);

        DB::statement('
        CREATE OR REPLACE VIEW `differentials_view` AS
        SELECT d.id, d.name
        FROM differentials as d
        WHERE d.deleted_at IS NULL
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('differentials');
        DB::statement('DROP VIEW differentials_view');
    }
};
