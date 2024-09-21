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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->softDeletes();
            $table->timestamps();
        });

        DB::table('categories')->insert([
            [
                'name' => 'Imóvel Residencial',
                'created_at' => new \DateTime('now'),
            ],
            [
                'name' => 'Comercial/Industrial',
                'created_at' => new \DateTime('now'),
            ],
            [
                'name' => 'Terreno',
                'created_at' => new \DateTime('now'),
            ],
        ]);

        DB::statement('
        CREATE OR REPLACE VIEW `categories_view` AS
        SELECT c.id, c.name
        FROM categories as c
        WHERE c.deleted_at IS NULL
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
        DB::statement('DROP VIEW categories_view');
    }
};
