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
        Schema::table('clients', function (Blueprint $table) {
            $table->string('instagram')->nullable();
        });

        DB::statement('
        CREATE OR REPLACE VIEW `clients_view` AS
        SELECT c.id, c.name, c.email, c.cell, a.alias_name, c.agency_id, 
        c.step_id, s.name as step, u.name as broker, c.created_at, c.property_interest, p.title as property_title, c.contact_message,
        c.instagram
        FROM clients c
        LEFT JOIN agencies a ON a.id = c.agency_id
        LEFT JOIN steps s ON s.id = c.step_id
        LEFT JOIN users u ON u.id = c.user_id
        LEFT JOIN properties p ON p.id = c.property_interest
        WHERE c.deleted_at IS NULL AND s.deleted_at IS NULL
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        DB::statement('
        CREATE OR REPLACE VIEW `clients_view` AS
        SELECT c.id, c.name, c.email, c.cell, a.alias_name, c.agency_id, c.step_id, s.name as step, u.name as broker, c.created_at, c.property_interest, p.title as property_title, c.contact_message
        FROM clients c
        LEFT JOIN agencies a ON a.id = c.agency_id
        LEFT JOIN steps s ON s.id = c.step_id
        LEFT JOIN users u ON u.id = c.user_id
        LEFT JOIN properties p ON p.id = c.property_interest
        WHERE c.deleted_at IS NULL AND s.deleted_at IS NULL
        ');

        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn('instagram');
        });
    }
};
