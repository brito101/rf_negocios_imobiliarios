<?php

use App\Models\Category;
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
        Schema::create('types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('category_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });

        DB::table('types')->insert([
            [
                'name' => 'Casa',
                'category_id' => Category::where('name', 'Imóvel Residencial')->first()->id,
                'created_at' => new \DateTime('now'),
            ],
            [
                'name' => 'Cobertura',
                'category_id' => Category::where('name', 'Imóvel Residencial')->first()->id,
                'created_at' => new \DateTime('now'),
            ],
            [
                'name' => 'Apartamento',
                'category_id' => Category::where('name', 'Imóvel Residencial')->first()->id,
                'created_at' => new \DateTime('now'),
            ],
            [
                'name' => 'Estúdio',
                'category_id' => Category::where('name', 'Imóvel Residencial')->first()->id,
                'created_at' => new \DateTime('now'),
            ],
            [
                'name' => 'Kitnet',
                'category_id' => Category::where('name', 'Imóvel Residencial')->first()->id,
                'created_at' => new \DateTime('now'),
            ],
            [
                'name' => 'Sala Comercial',
                'category_id' => Category::where('name', 'Comercial/Industrial')->first()->id,
                'created_at' => new \DateTime('now'),
            ],
            [
                'name' => 'Depósito/Galpão',
                'category_id' => Category::where('name', 'Comercial/Industrial')->first()->id,
                'created_at' => new \DateTime('now'),
            ],
            [
                'name' => 'Ponto Comercial',
                'category_id' => Category::where('name', 'Comercial/Industrial')->first()->id,
                'created_at' => new \DateTime('now'),
            ],
            [
                'name' => 'Terreno',
                'category_id' => Category::where('name', 'Terreno')->first()->id,
                'created_at' => new \DateTime('now'),
            ],
        ]);

        DB::statement('
        CREATE OR REPLACE VIEW `types_view` AS
        SELECT t.id, t.name, t.category_id, c.name as category
        FROM types as t
        LEFT JOIN categories as c ON c.id = t.category_id
        WHERE t.deleted_at IS NULL
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('types');
        DB::statement('DROP VIEW types_view');
    }
};
