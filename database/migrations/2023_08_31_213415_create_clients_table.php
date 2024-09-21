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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('document_person')->nullable();
            $table->string('document_registry')->nullable();
            /** contact */
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();
            $table->string('cell')->nullable();
            /** address */
            $table->string('zipcode')->nullable();
            $table->string('street')->nullable();
            $table->string('number')->nullable();
            $table->string('complement')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            /** extra */
            $table->text('company')->nullable();
            $table->longText('observations')->nullable();

            /** agency */
            $table->foreignId('agency_id')
                ->nullable()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            /** step */
            $table->foreignId('step_id')
                ->nullable()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            /** broker */
            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->date('meeting')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });

        DB::statement('
        CREATE OR REPLACE VIEW `clients_view` AS
        SELECT c.id, c.name, c.email, c.telephone, a.alias_name, c.agency_id, c.step_id, s.name as step, u.name as broker, c.created_at
        FROM clients c
        LEFT JOIN agencies a ON a.id = c.agency_id
        LEFT JOIN steps s ON s.id = c.step_id
        LEFT JOIN users u ON u.id = c.user_id
        WHERE c.deleted_at IS NULL AND s.deleted_at IS NULL
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
        DB::statement('DROP VIEW clients_view');
    }
};
